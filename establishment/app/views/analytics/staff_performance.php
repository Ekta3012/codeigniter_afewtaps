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
        <link href="<?php echo config_item('base_url'); ?>assets/css/datepicker.css" rel="stylesheet">
        <link href="<?php echo config_item('base_url'); ?>assets/css/awesome-bootstrap-checkbox.css" rel="stylesheet">
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

            /*            #chart #bars li .bar:hover {
                            background: #718fb5;
                            cursor: pointer;
                        }*/
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
            #example1_paginate{text-align: right;}
            #example1_filter{text-align: right;}
            #example2_paginate{text-align: right;}
            #example2_filter{text-align: right;}
            #example3_paginate{text-align: right;}
            #example3_filter{text-align: right;}

            #slide{
                border:1.5px solid black;
                position:absolute;
                top:0;
                left:0;
                width:150px;
                height:100%;
                background-color:#F2F2F2;
                layer-background-color:#F2F2F2;
            }
            .fnt12{font-size:11px}
            .padd2x5x{padding:2px 5px;font-size:10px}

            .popUp{position:fixed;z-index:10000}
            .orderBx {background:#FFF !important}



            .black_overlay {
                background-color: #333333;
                height: 0;
                left: 0;
                opacity: 0.7;
                position: absolute;
                top: 0;
                width: 100%;
                z-index: 1001;
            }




            .lnehght30{line-height:30px}
            .lnehght40{line-height:40px}
            .lnehght24{line-height:24px}
            .wdth100{width:100%}
            .wdth80{width:80%}
            .wdth20{width:20%}
            .fdItem{margin-left:20px;margin-bottom:10px;border-bottom:1px solid #ddd}
            .orderBx{border:1px solid #888;border-radius:5px;padding:10px;margin-bottom:4px !important;min-height:310px}
            .bold{font-weight:bold}
            .fntsz{font-size:20px}
            .extraseasoning {border:1px dashed #EAEAEA;line-height:24px;margin:10px 0}
            .bordrseason{border:1px dashed #888}
            .vg{background:url('../../assets/img/green_icon.png');background-repeat:no-repeat;width:20px;height:20px;float:left;background-position:center center}
            .nonvg{background:url('../../assets/img/red_icon.png');background-repeat:no-repeat;width:20px;height:20px;float:left;background-position:center center}
            .detailIconB{background:url('../../assets/img/arrowb.png');background-repeat:no-repeat;float:left;background-position:center center;cursor:pointer}
            .detailIconR{background:url('../../assets/img/arrowr.png');background-repeat:no-repeat;float:left;background-position:center center}
            .ordrtm,.offline{color:#c80000}
            .mrgntp10_0{margin:10px 0}
            .mrgnbtm20_0{margin:0 0 10px 0}

            .cross{background:url('../../assets/img/cross.png');background-repeat:no-repeat;background-position:center center}

            br {display:block;margin:0;line-height:12px}
            .brdrlne{border-bottom:1px solid #DDD}
            .pdbtm{padding-bottom:10px}
            .qty{border:1px solid #888;border-radius: 3px;line-height:14px;padding:2px 6px}
            .qtypend{border:1px solid #fff;border-radius: 3px;line-height:14px;padding:2px 6px}
            .vegIcon, .nonVegIcon{width:100%}
            .hr-line-dashed{margin:6px 0}
            .padleft20{padding-left:20px}
            .mrgn15{margin:15px 0}
            .mrgn25{margin:25px 0}
            .fntsze12{font-size:12px}
            .fntsze10{font-size:10px}
            .clr666{color:#666}
            .fntsze13{font-size:13px;line-height:28px}
            .flrbox{width:220px;float:left}
            .ordpend-line-dashed{border-top:1px dashed #c80000;}


            .tabs-container .nav-tabs > li.active > a, .tabs-container .nav-tabs > li.active > a:hover, .tabs-container .nav-tabs > li.active > a:focus { 
                background:none;
                border:none;
            }
            .nav-tabs { border:1px solid #e7eaec !important;margin-bottom:20px;background:#000;border-radius:10px}
            .tabs-container .tab-pane .panel-body { border:1px solid #e7eaec !important;}
            .nav-tabs > li > a {border-radius:none;color:#FFF;font-size:15px}
            .order_nav > li.active > a {color:#FF0000 !important}
            .badgecount{position:absolute;background:rgb(255, 0, 0) none repeat scroll 0% 0%; margin-left:3px;top:4px;font-weight:bold;padding:3px;min-width:20px; text-align:center;border-radius:10px;height:20px;font-size:10px;color:#FFF;right:25px}

            .detailIconU{background:url('../../assets/img/arrowu.png');background-repeat:no-repeat;float:left;background-position:center center;cursor:pointer}

            .popUp{position:fixed;z-index:10000}
            .orderBx {background:#FFF !important}

            #orderReason .orderBx {width:450px !important}
            #orderReason .fdItem {display:block !important;padding-bottom:10px}
            #orderReason #menuList {height:225px;overflow-y:scroll;overflow-x:none;width:100%}

            #orderReason_staff .orderBx {width:450px !important}
            #orderReason_staff .fdItem {display:block !important;padding-bottom:10px}
            #orderReason_staff #menuList {height:225px;overflow-y:scroll;overflow-x:none;width:100%}

            #orderReason_cust .orderBx {width:450px !important}
            #orderReason_cust .fdItem {display:block !important;padding-bottom:10px}
            #orderReason_cust #menuList {height:225px;overflow-y:scroll;overflow-x:none;width:100%}

            .black_overlay {
                background-color: #333333;
                height: 0;
                left: 0;
                opacity: 0.7;
                position: absolute;
                top: 0;
                width: 100%;
                z-index: 1001;
            }
        </style>
    </head>
    <body>
        <div id="fade" class="black_overlay"></div>
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

                                <div class="ibox-content">

                                    <?php echo form_open('analytics/staffAnalytics', array('id' => 'frm')); ?>

                                    <div class="row text-center">

                                        <div class="col-lg-2">						
                                        </div>

                                        <div class="col-lg-2">
                                        </div>


                                        <div class="col-lg-3">
                                            <select onchange="branchStaff(this.value)" name="employee" class="form-control m-b">
                                                <option value="">-- Employee Name --</option>
                                                <?php
                                                if (count($response['staff_members']) > 0) {
                                                    foreach ($response['staff_members'] as $rdata) {
                                                        $selected = ($rdata->id == $sid) ? "selected='selected'" : "";
                                                        echo '<option ' . $selected . ' value="' . $rdata->id . '">' . ucwords($rdata->name) . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>							
                                        </div>

                                        <div class="col-lg-2">

                                        </div>

                                    </div>

                                    <?php echo form_close(); ?>


                                    <?php if (!empty($response['staff_member_data'])) { ?>

                                        <div class="row">
                                            <div style="text-align:left" class="col-lg-12">
                                                <div class="contact-box" style="border:0">
                                                    <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Staff Performance Section</div>
                                                    <a href="#">
                                                        <div style="text-align:right;margin:20px 0 0 0" class="col-sm-6">
                                                            <div class="text-right pull-right" style="margin-right:10px">

                                                                <?php
                                                                if (isset($response['staff_member_data'])) {
                                                                    $pic = $response['staff_member_data']->pic;
                                                                    if (!empty($pic)) {
                                                                        echo '<img alt="image" class="img-circle m-t-xs img-responsive" src="' . base_url() . '../uploads/' . $pic . '" width="100" />';
                                                                    } else {
                                                                        echo '<img alt="image" class="img-circle m-t-xs img-responsive" src="' . base_url() . 'assets/img/user_icon.png" width="80" />';
                                                                    }
                                                                }
                                                                ?>

                                                            </div>
                                                        </div>
                                                        <div style="text-align:left;margin:25px 0 0 0" class="col-sm-6">
                                                            <h3><strong><?php echo isset($response['staff_member_data']) ? ucwords($response['staff_member_data']->name) : ''; ?></strong></h3>
                                                            <p><i class="fa fa-user"></i> Emp Id: <?php echo isset($response['staff_member_data']) ? $response['staff_member_data']->employee_id : ''; ?></p>
                                                            <p><i class="fa fa-mobile"></i> <?php echo isset($response['staff_member_data']) ? $response['staff_member_data']->contact_no : ''; ?></p>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>





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
                                                                            <?php
                                                                            if (isset($response['total_orders'])) {
                                                                                $t_o = $response['total_orders'];
                                                                                $s_t_o = $response['staff_total_orders'];
                                                                                $c_t_o = $response['customer_total_orders'];
                                                                                ?>
                                                                                <tr>
                                                                                    <th class="total_header"></th>
                                                                                    <th class="second_last_month"><?php echo $t_o[4]['month_year']; ?></th>
                                                                                    <th class="last_month"><?php echo $t_o[5]['month_year'] . "(this month so far)"; ?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th class="total_header">Total Orders</th>
                                                                                    <th class="second_last_month"><?php echo $t_o[4]['total_order']; ?></th>
                                                                                    <th class="last_month"><?php echo $t_o[5]['total_order']; ?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th class="total_header">Staff Orders</th>
                                                                                    <th class="second_last_month"><?php echo $s_t_o[4]['total_order']; ?></th>
                                                                                    <th class="last_month"><?php echo $s_t_o[5]['total_order']; ?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th class="total_header">Customer Orders</th>
                                                                                    <th class="second_last_month"><?php echo $c_t_o[4]['total_order']; ?></th>
                                                                                    <th class="last_month"><?php echo $c_t_o[5]['total_order']; ?></th>
                                                                                </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!--/.box-body--> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="box box-solid bg-teal-gradient">
                                                                <?php
                                                                if (isset($response['staff_total_orders'])) {
                                                                    $hit = array();
                                                                    foreach ($response['staff_total_orders'] as $sco) {
                                                                        $hit[] = $sco['total_order'];
                                                                    }
                                                                    $ori_hight = max($hit);
                                                                    $hight = max($hit);
                                                                    $multiplier = 1;
                                                                    do {
                                                                        if ($ori_hight > 100 * $multiplier) {
                                                                            $hight = 100 * ($multiplier + 1);
                                                                            ++$multiplier;
                                                                        } else {
                                                                            $hight = 100 * $multiplier;
                                                                        }
                                                                    } while ($hight < $ori_hight);

                                                                    $level = $hight / 5;
                                                                    ?>

                                                                    <div id="chart"> 
                                                                        <!--                                                <ul id="numbers">
                                                                        <?php for ($j = 5; $j >= 1; $j--) { ?>
                                                                                                                                            <li><span><?php echo $level * $j; ?></span></li>
                                                                        <?php } ?>
                                                                           <li><span>0</span></li>
                                                                           
                                                                         </ul>-->
                                                                        <ul id="bars">
                                                                            <?php foreach ($response['staff_total_orders'] as $sco) { ?>
                                                                                <li>
                                                                                    <?php $data_percentage = $sco['total_order'] / $multiplier; ?>
                                                                                    <div data-percentage="<?php echo $sco['total_order']; ?>" data-percentage1="<?php echo $data_percentage; ?>" class="bar"></div>
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
                                                            <div class="box-header text-center" style="margin-top: 75px;">
                                                                <h3 class="graph_footer_head">Staff Orders</h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="box box-solid bg-teal-gradient">
                                                                <?php
                                                                if (isset($response['customer_total_orders'])) {
                                                                    $hit = array();
                                                                    foreach ($response['customer_total_orders'] as $sco) {
                                                                        $hit[] = $sco['total_order'];
                                                                    }
                                                                    $ori_hight = max($hit);
                                                                    $hight = max($hit);
                                                                    $multiplier = 1;
                                                                    do {
                                                                        if ($ori_hight > 100 * $multiplier) {
                                                                            $hight = 100 * ($multiplier + 1);
                                                                            ++$multiplier;
                                                                        } else {
                                                                            $hight = 100 * $multiplier;
                                                                        }
                                                                    } while ($hight < $ori_hight);

                                                                    $level = $hight / 5;
                                                                    ?>

                                                                    <div id="chart"> 
                                                                        <!--                                                <ul id="numbers">
                                                                        <?php for ($j = 5; $j >= 1; $j--) { ?>
                                                                                                                                            <li><span><?php echo $level * $j; ?></span></li>
                                                                        <?php } ?>
                                                                           <li><span>0</span></li>
                                                                           
                                                                         </ul>-->
                                                                        <ul id="bars">
                                                                            <?php foreach ($response['customer_total_orders'] as $sco) { ?>
                                                                                <li>
                                                                                    <?php $data_percentage = $sco['total_order'] / $multiplier; ?>
                                                                                    <div data-percentage="<?php
                                                                                    if ($sco['month_numeric'] == date('m')) {
                                                                                        echo $sco['total_order'];
                                                                                    } else {
                                                                                        echo $sco['total_order'];
                                                                                    }
                                                                                    ?>" data-percentage1="<?php echo $data_percentage; ?>" class="bar" style="cursor:pointer;"></div>
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
                                                                            <?php
                                                                            if (isset($response['total_completed_orders'])) {
                                                                                $tmgb = $response['total_completed_orders'];
                                                                                $s_tmgb = $response['staff_completed_orders'];
                                                                                $c_tmgb = $response['customer_completed_orders'];
                                                                                ?>
                                                                                <tr>
                                                                                    <th class="total_header"></th>
                                                                                    <th class="second_last_month"><?php echo $tmgb[4]['month_year']; ?></th>
                                                                                    <th class="last_month"><?php echo $tmgb[5]['month_year'] . "(this month so far)"; ?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th class="total_header">Total Orders</th>
                                                                                    <th class="second_last_month"><?php echo $tmgb[4]['total_order']; ?></th>
                                                                                    <th class="last_month"><?php echo $tmgb[5]['total_order']; ?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th class="total_header">Staff Orders</th>
                                                                                    <th class="second_last_month"><?php echo $s_tmgb[4]['total_order']; ?></th>
                                                                                    <th class="last_month"><?php echo $s_tmgb[5]['total_order']; ?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th class="total_header">Customer Orders</th>
                                                                                    <th class="second_last_month"><?php echo $c_tmgb[4]['total_order']; ?></th>
                                                                                    <th class="last_month"><?php echo $c_tmgb[5]['total_order']; ?></th>
                                                                                </tr>
    <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!--/.box-body--> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="box box-solid bg-teal-gradient">
                                                                <?php
                                                                if (isset($response['staff_completed_orders'])) {
                                                                    $hit = array();
                                                                    foreach ($response['staff_completed_orders'] as $sco) {
                                                                        $hit[] = $sco['total_order'];
                                                                    }
                                                                    $ori_hight = max($hit);
                                                                    $hight = max($hit);
                                                                    $multiplier = 1;
                                                                    do {
                                                                        if ($ori_hight > 100 * $multiplier) {
                                                                            $hight = 100 * ($multiplier + 1);
                                                                            ++$multiplier;
                                                                        } else {
                                                                            $hight = 100 * $multiplier;
                                                                        }
                                                                    } while ($hight < $ori_hight);

                                                                    $level = $hight / 5;
                                                                    ?>

                                                                    <div id="chart"> 
                                                                        <!--                                                <ul id="numbers">
                                                                        <?php for ($j = 5; $j >= 1; $j--) { ?>
                                                                                                                                            <li><span><?php echo $level * $j; ?></span></li>
        <?php } ?>
                                                                           <li><span>0</span></li>
                                                                           
                                                                         </ul>-->
                                                                        <ul id="bars">
                                                                                <?php foreach ($response['staff_completed_orders'] as $sco) { ?>
                                                                                <li>
            <?php $data_percentage = $sco['total_order'] / $multiplier; ?>
                                                                                    <div data-percentage="<?php echo $sco['total_order']; ?>" data-percentage1="<?php echo $data_percentage; ?>" class="bar" style="cursor:pointer;"></div>
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
                                                            <div class="box-header text-center" style="margin-top: 75px;">
                                                                <h3 class="graph_footer_head">Staff Orders</h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="box box-solid bg-teal-gradient">
                                                                <?php
                                                                if (isset($response['customer_completed_orders'])) {
                                                                    $hit = array();
                                                                    foreach ($response['customer_completed_orders'] as $sco) {
                                                                        $hit[] = $sco['total_order'];
                                                                    }
                                                                    $ori_hight = max($hit);
                                                                    $hight = max($hit);
                                                                    $multiplier = 1;
                                                                    do {
                                                                        if ($ori_hight > 100 * $multiplier) {
                                                                            $hight = 100 * ($multiplier + 1);
                                                                            ++$multiplier;
                                                                        } else {
                                                                            $hight = 100 * $multiplier;
                                                                        }
                                                                    } while ($hight < $ori_hight);

                                                                    $level = $hight / 5;
                                                                    ?>

                                                                    <div id="chart"> 
                                                                        <!--                                                <ul id="numbers">
                                                                        <?php for ($j = 5; $j >= 1; $j--) { ?>
                                                                                                                                            <li><span><?php echo $level * $j; ?></span></li>
        <?php } ?>
                                                                           <li><span>0</span></li>
                                                                           
                                                                         </ul>-->
                                                                        <ul id="bars">
                                                                                <?php foreach ($response['customer_completed_orders'] as $sco) { ?>
                                                                                <li>
            <?php $data_percentage = $sco['total_order'] / $multiplier; ?>
                                                                                    <div data-percentage="<?php echo $sco['total_order']; ?>" data-percentage1="<?php echo $data_percentage; ?>" class="bar" style="cursor:pointer;"></div>
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
                                                                            <?php
                                                                            if (isset($response['total_cancelled_orders'])) {
                                                                                $t_c_o = $response['total_cancelled_orders'];
                                                                                $s_t_c_o = $response['staff_cancelled_orders'];
                                                                                $c_t_c_o = $response['customer_cancelled_orders'];
                                                                                ?>
                                                                                <tr>
                                                                                    <th class="total_header"></th>
                                                                                    <th class="second_last_month"><?php echo $t_c_o[4]['month_year']; ?></th>
                                                                                    <th class="last_month"><?php echo $t_c_o[5]['month_year'] . "(this month so far)"; ?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th class="total_header">Total Orders</th>
                                                                                    <th class="second_last_month"><?php echo $t_c_o[4]['total_order']; ?></th>
                                                                                    <th class="last_month"><?php echo $t_c_o[5]['total_order']; ?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th class="total_header">Staff Orders</th>
                                                                                    <th class="second_last_month"><?php echo $s_t_c_o[4]['total_order']; ?></th>
                                                                                    <th class="last_month"><?php echo $s_t_c_o[5]['total_order']; ?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th class="total_header">Customer Orders</th>
                                                                                    <th class="second_last_month"><?php echo $c_t_c_o[4]['total_order']; ?></th>
                                                                                    <th class="last_month"><?php echo $c_t_c_o[5]['total_order']; ?></th>
                                                                                </tr>
    <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!--/.box-body--> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="box box-solid bg-teal-gradient">
                                                                <?php
                                                                if (isset($response['staff_cancelled_orders'])) {
                                                                    $hit = array();
                                                                    foreach ($response['staff_cancelled_orders'] as $sco) {
                                                                        $hit[] = $sco['total_order'];
                                                                    }
                                                                    $ori_hight = max($hit);
                                                                    $hight = max($hit);
                                                                    $multiplier = 1;
                                                                    do {
                                                                        if ($ori_hight > 100 * $multiplier) {
                                                                            $hight = 100 * ($multiplier + 1);
                                                                            ++$multiplier;
                                                                        } else {
                                                                            $hight = 100 * $multiplier;
                                                                        }
                                                                    } while ($hight < $ori_hight);

                                                                    $level = $hight / 5;
                                                                    ?>

                                                                    <div id="chart"> 
                                                                        <!--                                                <ul id="numbers">
                                                                        <?php for ($j = 5; $j >= 1; $j--) { ?>
                                                                                                                                            <li><span><?php echo $level * $j; ?></span></li>
        <?php } ?>
                                                                           <li><span>0</span></li>
                                                                           
                                                                         </ul>-->
                                                                        <ul id="bars">
                                                                                <?php foreach ($response['staff_cancelled_orders'] as $sco) { ?>
                                                                                <li>
            <?php $data_percentage = $sco['total_order'] / $multiplier; ?>
                                                                                    <div data-percentage="<?php echo $sco['total_order']; ?>" data-percentage1="<?php echo $data_percentage; ?>" class="bar" style="cursor:pointer;"></div>
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
                                                            <div class="box-header text-center" style="margin-top: 75px;">
                                                                <h3 class="graph_footer_head">Staff Orders</h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="box box-solid bg-teal-gradient">
                                                                <?php
                                                                if (isset($response['customer_cancelled_orders'])) {
                                                                    $hit = array();
                                                                    foreach ($response['customer_cancelled_orders'] as $sco) {
                                                                        $hit[] = $sco['total_order'];
                                                                    }
                                                                    $ori_hight = max($hit);
                                                                    $hight = max($hit);
                                                                    $multiplier = 1;
                                                                    do {
                                                                        if ($ori_hight > 100 * $multiplier) {
                                                                            $hight = 100 * ($multiplier + 1);
                                                                            ++$multiplier;
                                                                        } else {
                                                                            $hight = 100 * $multiplier;
                                                                        }
                                                                    } while ($hight < $ori_hight);

                                                                    $level = $hight / 5;
                                                                    ?>

                                                                    <div id="chart"> 
                                                                        <!--                                                <ul id="numbers">
                                                                        <?php for ($j = 5; $j >= 1; $j--) { ?>
                                                                                                                                            <li><span><?php echo $level * $j; ?></span></li>
        <?php } ?>
                                                                           <li><span>0</span></li>
                                                                           
                                                                         </ul>-->
                                                                        <ul id="bars">
                                                                                <?php foreach ($response['customer_cancelled_orders'] as $sco) { ?>
                                                                                <li>
            <?php $data_percentage = $sco['total_order'] / $multiplier; ?>
                                                                                    <div data-percentage="<?php echo $sco['total_order']; ?>" data-percentage1="<?php echo $data_percentage; ?>" class="bar" style="cursor:pointer;"></div>
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
                                                                            <?php
                                                                            if (isset($response['total_threshold_orders'])) {
                                                                                $t_t_o = $response['total_threshold_orders'];
                                                                                $s_t_t_o = $response['staff_threshold_orders'];
                                                                                $c_t_t_o = $response['customer_threshold_orders'];
                                                                                ?>
                                                                                <tr>
                                                                                    <th class="total_header"></th>
                                                                                    <th class="second_last_month"><?php echo $t_t_o[4]['month_year']; ?></th>
                                                                                    <th class="last_month"><?php echo $t_t_o[5]['month_year'] . "(this month so far)"; ?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th class="total_header">Total Orders</th>
                                                                                    <th class="second_last_month"><?php echo $t_t_o[4]['total_order']; ?></th>
                                                                                    <th class="last_month"><?php echo $t_t_o[5]['total_order']; ?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th class="total_header">Staff Orders</th>
                                                                                    <th class="second_last_month"><?php echo $s_t_t_o[4]['total_order']; ?></th>
                                                                                    <th class="last_month"><?php echo $s_t_t_o[5]['total_order']; ?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th class="total_header">Customer Orders</th>
                                                                                    <th class="second_last_month"><?php echo $c_t_t_o[4]['total_order']; ?></th>
                                                                                    <th class="last_month"><?php echo $c_t_t_o[5]['total_order']; ?></th>
                                                                                </tr>
    <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!--/.box-body--> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="box box-solid bg-teal-gradient">
                                                                <?php
                                                                if (isset($response['staff_threshold_orders'])) {
                                                                    $hit = array();
                                                                    foreach ($response['staff_threshold_orders'] as $sco) {
                                                                        $hit[] = $sco['total_order'];
                                                                    }
                                                                    $ori_hight = max($hit);
                                                                    $hight = max($hit);
                                                                    $multiplier = 1;
                                                                    do {
                                                                        if ($ori_hight > 100 * $multiplier) {
                                                                            $hight = 100 * ($multiplier + 1);
                                                                            ++$multiplier;
                                                                        } else {
                                                                            $hight = 100 * $multiplier;
                                                                        }
                                                                    } while ($hight < $ori_hight);

                                                                    $level = $hight / 5;
                                                                    ?>

                                                                    <div id="chart"> 
                                                                        <!--                                                <ul id="numbers">
                                                                        <?php for ($j = 5; $j >= 1; $j--) { ?>
                                                                                                                                            <li><span><?php echo $level * $j; ?></span></li>
        <?php } ?>
                                                                           <li><span>0</span></li>
                                                                           
                                                                         </ul>-->
                                                                        <ul id="bars">
                                                                                <?php foreach ($response['staff_threshold_orders'] as $sco) { ?>
                                                                                <li>
            <?php $data_percentage = $sco['total_order'] / $multiplier; ?>
                                                                                    <div data-percentage="<?php echo $sco['total_order']; ?>" data-percentage1="<?php echo $data_percentage; ?>" class="bar" style="cursor:pointer;"></div>
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
                                                            <div class="box-header text-center" style="margin-top: 75px;">
                                                                <h3 class="graph_footer_head">Staff Orders</h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="box box-solid bg-teal-gradient">
                                                                <?php
                                                                if (isset($response['customer_threshold_orders'])) {
                                                                    $hit = array();
                                                                    foreach ($response['customer_threshold_orders'] as $sco) {
                                                                        $hit[] = $sco['total_order'];
                                                                    }
                                                                    $ori_hight = max($hit);
                                                                    $hight = max($hit);
                                                                    $multiplier = 1;
                                                                    do {
                                                                        if ($ori_hight > 100 * $multiplier) {
                                                                            $hight = 100 * ($multiplier + 1);
                                                                            ++$multiplier;
                                                                        } else {
                                                                            $hight = 100 * $multiplier;
                                                                        }
                                                                    } while ($hight < $ori_hight);

                                                                    $level = $hight / 5;
                                                                    ?>

                                                                    <div id="chart"> 
                                                                        <!--                                                <ul id="numbers">
                                                                        <?php for ($j = 5; $j >= 1; $j--) { ?>
                                                                                                                                            <li><span><?php echo $level * $j; ?></span></li>
        <?php } ?>
                                                                           <li><span>0</span></li>
                                                                           
                                                                         </ul>-->
                                                                        <ul id="bars">
                                                                                <?php foreach ($response['customer_threshold_orders'] as $sco) { ?>
                                                                                <li>
            <?php $data_percentage = $sco['total_order'] / $multiplier; ?>
                                                                                    <div data-percentage="<?php echo $sco['total_order']; ?>" data-percentage1="<?php echo $data_percentage; ?>" class="bar" style="cursor:pointer;"></div>
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
                                                            <div class="box-header text-center" style="margin-top: 75px;">
                                                                <h3 class="graph_footer_head">Customer Orders</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="col-selector" style="background-color: #ffffff;padding-bottom: 100px;">
                                                    <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Business Generated</div>
                                                    <div class="clearfix">
                                                        <div class="col-md-6 col-md-offset-3">
                                                            <div class="box">
                                                                <div class="box-header">
                                                                    <h3 class="box-title">Total Business Generated</h3>
                                                                </div>
                                                                <!-- /.box-header -->
                                                                <div class="box-body no-padding">


                                                                    <table class="table table-condensed">
                                                                        <tbody>       
                                                                            <?php
                                                                            if (isset($response['total_monthly_generated_business'])) {
                                                                                $tmgb = $response['total_monthly_generated_business'];
                                                                                $s_tmgb = $response['staff_monthly_generated_business'];
                                                                                $c_tmgb = $response['customer_monthly_generated_business'];
                                                                                ?>
                                                                                <tr>
                                                                                    <th class="total_header"></th>
                                                                                    <th class="second_last_month"><?php echo $tmgb[4]['month_year']; ?></th>
                                                                                    <th class="last_month"><?php echo $tmgb[5]['month_year'] . "(this month so far)"; ?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th class="total_header">Total Orders</th>
                                                                                    <th class="second_last_month"><?php echo $tmgb[4]['amount']; ?></th>
                                                                                    <th class="last_month"><?php echo $tmgb[5]['amount']; ?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th class="total_header">Staff Orders</th>
                                                                                    <th class="second_last_month"><?php echo $s_tmgb[4]['amount']; ?></th>
                                                                                    <th class="last_month"><?php echo $s_tmgb[5]['amount']; ?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th class="total_header">Customer Orders</th>
                                                                                    <th class="second_last_month"><?php echo $c_tmgb[4]['amount']; ?></th>
                                                                                    <th class="last_month"><?php echo $c_tmgb[5]['amount']; ?></th>
                                                                                </tr>
    <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- /.box-body -->
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="box box-solid bg-teal-gradient">
                                                                <?php
                                                                if (isset($response['staff_monthly_generated_business'])) {
                                                                    $hit = array();
                                                                    foreach ($response['staff_monthly_generated_business'] as $sco) {
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

                                                                    <div id="chart"> 
                                                                        <!--                                                    <ul id="numbers">
                                                                        <?php for ($j = 5; $j >= 1; $j--) { ?>
                                                                                                                                                <li><span><?php echo $level * $j; ?></span></li>
        <?php } ?>
                                                                                                                                <li><span>0</span></li>
                                                                        
                                                                                                                            </ul>-->
                                                                        <ul id="bars">
                                                                                <?php foreach ($response['staff_monthly_generated_business'] as $sco) { ?>
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
                                                            <div class="box-header text-center" style="margin-top: 75px;">
                                                                <h3 class="graph_footer_head">Staff Orders</h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="box">
                                                                <?php
                                                                if (isset($response['customer_monthly_generated_business'])) {
                                                                    $hit = array();
                                                                    foreach ($response['customer_monthly_generated_business'] as $sco) {
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
                                                                    <div id="chart"> 
                                                                        <!--                                                    <ul id="numbers">
                                                                        <?php for ($j = 5; $j >= 1; $j--) { ?>
                                                                                                                                                <li><span><?php echo $level * $j; ?></span></li>
        <?php } ?>
                                                                                                                                <li><span>0</span></li>
                                                                        
                                                                                                                            </ul>-->
                                                                        <ul id="bars">
                                                                                <?php foreach ($response['customer_monthly_generated_business'] as $sco) { ?>
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
                                                            <div class="box-header text-center" style="margin-top: 75px;">
                                                                <h3 class="graph_footer_head" >Customer Orders</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="col-selector" style="background-color: #ffffff;padding-bottom: 100px;">
                                                    <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Average Order Completion Time</div>
                                                    <div class="clearfix">
                                                        <div class="col-md-6 col-md-offset-3">
                                                            <div class="box">
                                                                <div class="box-header">
                                                                    <h3 class="box-title">Average Order Completion Time Of Total Orders</h3>
                                                                </div>
                                                                <!-- /.box-header -->
                                                                <div class="box-body no-padding">


                                                                    <table class="table table-condensed">
                                                                        <tbody>       
                                                                            <?php
                                                                            if (isset($response['total_orders_avg_time'])) {
                                                                                $tmgb = $response['total_orders_avg_time'];
                                                                                $s_tmgb = $response['staff_total_orders_avg_time'];
                                                                                $c_tmgb = $response['customer_total_orders_avg_time'];
                                                                                ?>
                                                                                <tr>
                                                                                    <th class="total_header"></th>
                                                                                    <th class="second_last_month"><?php echo $tmgb[4]['month_year']; ?></th>
                                                                                    <th class="last_month"><?php echo $tmgb[5]['month_year'] . "(this month so far)"; ?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th class="total_header">Total Orders</th>
                                                                                    <th class="second_last_month"><?php echo $tmgb[4]['avg_time'] . " min"; ?></th>
                                                                                    <th class="last_month"><?php echo $tmgb[5]['avg_time'] . " min"; ?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th class="total_header">Staff Orders</th>
                                                                                    <th class="second_last_month"><?php echo $s_tmgb[4]['avg_time'] . " min"; ?></th>
                                                                                    <th class="last_month"><?php echo $s_tmgb[5]['avg_time'] . " min"; ?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th class="total_header">Customer Orders</th>
                                                                                    <th class="second_last_month"><?php echo $c_tmgb[4]['avg_time'] . " min"; ?></th>
                                                                                    <th class="last_month"><?php echo $c_tmgb[5]['avg_time'] . " min"; ?></th>
                                                                                </tr>
    <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- /.box-body -->
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="box box-solid bg-teal-gradient">
                                                                <?php
                                                                if (isset($response['staff_total_orders_avg_time'])) {
                                                                    $hit = array();
                                                                    foreach ($response['staff_total_orders_avg_time'] as $sco) {
                                                                        $hit[] = $sco['avg_time'];
                                                                    }
                                                                    $ori_hight = max($hit);
                                                                    $hight = max($hit);
                                                                    $multiplier = 1;
                                                                    do {
                                                                        if ($ori_hight > 100 * $multiplier) {
                                                                            $hight = 100 * ($multiplier + 1);
                                                                            ++$multiplier;
                                                                        } else {
                                                                            $hight = 100 * $multiplier;
                                                                        }
                                                                    } while ($hight < $ori_hight);

                                                                    $level = $hight / 5;
                                                                    ?>

                                                                    <div id="chart"> 
                                                                        <!--                                                <ul id="numbers">
                                                                        <?php for ($j = 5; $j >= 1; $j--) { ?>
                                                                                                                                            <li><span><?php echo $level * $j; ?></span></li>
        <?php } ?>
                                                                           <li><span>0</span></li>
                                                                           
                                                                         </ul>-->
                                                                        <ul id="bars">
                                                                                <?php foreach ($response['staff_total_orders_avg_time'] as $sco) { ?>
                                                                                <li>
            <?php $data_percentage = $sco['avg_time'] / $multiplier; ?>
                                                                                    <div data-percentage="<?php echo $sco['avg_time']; ?>" data-percentage1="<?php echo $data_percentage; ?>" class="bar"></div>
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
                                                            <div class="box-header text-center" style="margin-top: 75px;">
                                                                <h3 class="graph_footer_head">Staff Orders</h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="box box-solid bg-teal-gradient">
                                                                <?php
                                                                if (isset($response['customer_total_orders_avg_time'])) {
                                                                    $hit = array();
                                                                    foreach ($response['customer_total_orders_avg_time'] as $sco) {
                                                                        $hit[] = $sco['avg_time'];
                                                                    }
                                                                    $ori_hight = max($hit);
                                                                    $hight = max($hit);
                                                                    $multiplier = 1;
                                                                    do {
                                                                        if ($ori_hight > 100 * $multiplier) {
                                                                            $hight = 100 * ($multiplier + 1);
                                                                            ++$multiplier;
                                                                        } else {
                                                                            $hight = 100 * $multiplier;
                                                                        }
                                                                    } while ($hight < $ori_hight);

                                                                    $level = $hight / 5;
                                                                    ?>

                                                                    <div id="chart"> 
                                                                        <!--                                                <ul id="numbers">
                                                                        <?php for ($j = 5; $j >= 1; $j--) { ?>
                                                                                                                                            <li><span><?php echo $level * $j; ?></span></li>
        <?php } ?>
                                                                           <li><span>0</span></li>
                                                                           
                                                                         </ul>-->
                                                                        <ul id="bars">
                                                                                <?php foreach ($response['customer_total_orders_avg_time'] as $sco) { ?>
                                                                                <li>
            <?php $data_percentage = $sco['avg_time'] / $multiplier; ?>
                                                                                    <div data-percentage="<?php echo $sco['avg_time']; ?>" data-percentage1="<?php echo $data_percentage; ?>" class="bar" style="cursor:pointer;"></div>
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
                                                            <div class="box-header text-center" style="margin-top: 75px;">
                                                                <h3 class="graph_footer_head">Customer Orders</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div style="text-align:left" class="col-lg-12">

                                                <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">List of All Orders</div>
                                                <div class="box" style="margin: 85px 0;">
                                                    <div class="box-header">
                                                        <h3 class="box-title"></h3>
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        <table id="example1" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>S No</th>
                                                                    <th>Order#</th>
                                                                    <th>Time & Date</th>
                                                                    <th>Delivery Status</th>
                                                                    <th>Location</th>
                                                                    <th>Order Completion Time</th>
                                                                    <th>Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                if (isset($response['orders_list']['list_of_all_orders'])) {
                                                                    $cntr = 0;
                                                                    foreach ($response['orders_list']['list_of_all_orders'] as $alordr) {
                                                                        ++$cntr;
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $cntr; ?></td>
                                                                            <td>
                                                                                <a onclick="showPopUp(<?php echo $alordr['order_id']; ?>)" href="javascript:void(0)"><?php echo $alordr['order_id']; ?></a>
                                                                                <br>
                                                                            </td>
                                                                            <td><?php echo date('d-M-Y h:i a', $alordr['order_time']); ?></td>
                                                                            <td>                                                                                                                  <?php
                                                                                if ($alordr['status'] == '1') {
                                                                                    echo "Preparation";
                                                                                } else if ($alordr['status'] == '2') {
                                                                                    echo "Priority";
                                                                                } else if ($alordr['status'] == '3') {
                                                                                    echo "Completed";
                                                                                } else if ($alordr['status'] == '4') {
                                                                                    echo "Cancelled";
                                                                                } else if ($alordr['status'] == '5') {
                                                                                    echo "Threshold";
                                                                                }
                                                                                ?>                                                                                                                  </td>

                                                                            <td><?php echo getOrderLocation($alordr['location']); ?></td>                                                                                                                     <td><?php
                                                                                if ($alordr['status'] == '3') {
                                                                                    if ($alordr['completion_time'] > 0) {
                                                                                        $order_time = $alordr['order_time'];
                                                                                        $complete_time = $alordr['completion_time'];
                                                                                        if ($complete_time > 0) {
                                                                                            echo $min = intval((($complete_time - $order_time) / 60));
                                                                                            $sec = (($complete_time - $order_time) % 60);
                                                                                            echo ":" . number_format($sec, 2);
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?></td>

                                                                            <td><?php echo $alordr['total_amount'] . "/-"; ?></td>
                                                                        </tr>

        <?php }
    } ?>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>


                                        </div>
                                        <div class="row">
                                            <div style="text-align:left" class="col-lg-12">

                                                <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">List of Staff Orders</div>
                                                <div class="box" style="margin: 85px 0;">
                                                    <div class="box-header">
                                                        <h3 class="box-title"></h3>
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        <table id="example2" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>S No</th>
                                                                    <th>Order#</th>
                                                                    <th>Time & Date</th>
                                                                    <th>Delivery Status</th>
                                                                    <th>Location</th>
                                                                    <th>Order Completion Time</th>
                                                                    <th>Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                if (isset($response['orders_list']['list_of_staff_orders'])) {
                                                                    $cntr = 0;
                                                                    foreach ($response['orders_list']['list_of_staff_orders'] as $alordr) {
                                                                        ++$cntr;
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $cntr; ?></td>
                                                                            <td><a onclick="showPopUp_staff(<?php echo $alordr['order_id']; ?>)" href="javascript:void(0)"><?php echo $alordr['order_id']; ?></a></td>
                                                                            <td><?php echo date('d-M-Y h:i a', $alordr['order_time']); ?></td>
                                                                            <td>                                                                                                                  <?php
                                                                                if ($alordr['status'] == '1') {
                                                                                    echo "Preparation";
                                                                                } else if ($alordr['status'] == '2') {
                                                                                    echo "Priority";
                                                                                } else if ($alordr['status'] == '3') {
                                                                                    echo "Completed";
                                                                                } else if ($alordr['status'] == '4') {
                                                                                    echo "Cancelled";
                                                                                } else if ($alordr['status'] == '5') {
                                                                                    echo "Threshold";
                                                                                }
                                                                                ?>                                                                                                                  </td>

                                                                            <td><?php echo getOrderLocation($alordr['location']); ?></td>                                                                                                                     <td><?php
                                                                                if ($alordr['status'] == '3') {
                                                                                    if ($alordr['completion_time'] > 0) {
                                                                                        $cmltn_time = ($alordr['completion_time'] - $alordr['order_time']);
                                                                                    } else {
                                                                                        $cmltn_time = 0;
                                                                                    }
                                                                                    $cmltn_time = $cmltn_time / 60;
                                                                                    echo number_format($cmltn_time, 2) . " min";
                                                                                }
                                                                                ?></td>

                                                                            <td><?php echo $alordr['total_amount'] . "/-"; ?></td>
                                                                        </tr>
        <?php
        }
    }
    ?>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div style="text-align:left" class="col-lg-12">

                                                <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">List of Customer Orders</div>
                                                <div class="box" style="margin: 85px 0;">
                                                    <div class="box-header">
                                                        <h3 class="box-title"></h3>
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        <table id="example3" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>S No</th>
                                                                    <th>Order#</th>
                                                                    <th>Time & Date</th>
                                                                    <th>Delivery Status</th>
                                                                    <th>Location</th>
                                                                    <th>Order Completion Time</th>
                                                                    <th>Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                if (isset($response['orders_list']['list_of_customer_orders'])) {
                                                                    $cntr = 0;
                                                                    foreach ($response['orders_list']['list_of_customer_orders'] as $alordr) {
                                                                        ++$cntr;
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $cntr; ?></td>
                                                                            <td><a onclick="showPopUp_cust(<?php echo $alordr['order_id']; ?>)" href="javascript:void(0)"><?php echo $alordr['order_id']; ?></a></td>
                                                                            <td><?php echo date('d-M-Y h:i a', $alordr['order_time']); ?></td>
                                                                            <td>                                                                                                                  <?php
                                                                                if ($alordr['status'] == '1') {
                                                                                    echo "Preparation";
                                                                                } else if ($alordr['status'] == '2') {
                                                                                    echo "Priority";
                                                                                } else if ($alordr['status'] == '3') {
                                                                                    echo "Completed";
                                                                                } else if ($alordr['status'] == '4') {
                                                                                    echo "Cancelled";
                                                                                } else if ($alordr['status'] == '5') {
                                                                                    echo "Threshold";
                                                                                }
                                                                                ?>                                                                                                                  </td>

                                                                            <td><?php echo getOrderLocation($alordr['location']); ?></td>                                                                                                                     <td><?php
                                                                                if ($alordr['status'] == '3') {
                                                                                    if ($alordr['completion_time'] > 0) {
                                                                                        $cmltn_time = ($alordr['completion_time'] - $alordr['order_time']);
                                                                                    } else {
                                                                                        $cmltn_time = 0;
                                                                                    }
                                                                                    $cmltn_time = $cmltn_time / 60;
                                                                                    echo number_format($cmltn_time, 2) . " min";
                                                                                }
                                                                                ?></td>

                                                                            <td><?php echo $alordr['total_amount'] . "/-"; ?></td>
                                                                        </tr>
        <?php
        }
    }
    ?>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>


                                        </div>
                                        <div id="orderReason" class='popUp' >
                                            <?php
                                            if (isset($response['orders_list']['list_of_all_orders'])) {

                                                $cntr = 0;
                                                foreach ($response['orders_list']['list_of_all_orders'] as $result) {

                                                    ++$cntr;
                                                    ?>  
                                                    <div class='containerOrder' id="orderBoxContainer<?php echo $result['order_id']; ?>" style="display:none">
                                                        <div class="contact-box orderBx">
                                                            <a href="#">
                                                                <div class="col-sm-12">
                                                                    <div class="pull-left wdth100">
                                                                        <div class="pull-left text-left lnehght30">Order #<?php echo $result['order_id']; ?></div>
                                                                        <div class="pull-right text-right lnehght30 "><i class="fa fa-inr"></i> <?php echo $result['total_amount']; ?> /-</div>
                                                                    </div>

                                                                    <div class="pull-left wdth100 pdbtm">
                                                                        <div class="pull-left text-left lnehght24"><?php echo date('h:i a', ($result['order_time'])) . ', ' . date('d-M-Y', ($result['order_time'])); ?> <br /><i class="fa fa-map-marker"></i> <?php echo getOrderLocation($result['location']); ?><br /><i class="fa fa-user"></i> <?php
                                                                if ($result['added_by'] == '1') {
                                                                    ?>
                                                                                <td class="center"><?php echo ucwords($result['staff_member_name']); ?> </td>
                <?php
            } else if ($result['added_by'] == '2') {
                ?>
                                                                                <td class="center"><?php echo ucwords($result['staff_member_name']); ?></td><?php } ?>
                                                                        </div>


                                                                        <div class="pull-right text-right lnehght24"><?php
                                                                            if ($result['payment_method'] == '1') {
                                                                                echo "Credit Purchase";
                                                                            } else if ($result['payment_method'] == '2') {
                                                                                echo "Cash On Delivery";
                                                                            } else if ($result['payment_method'] == '3') {
                                                                                echo "PayU";
                                                                            }
                                                                            ?><br /><i class="fa fa-clock-o"></i> <span class=""><?php
                                                                                $order_time = $result['order_time'];
                                                                                $complete_time = $result['completion_time'];
                                                                                if ($complete_time > 0) {
                                                                                    echo $min = intval((($complete_time - $order_time) / 60));
                                                                                    echo ":" . $sec = (($complete_time - $order_time) % 60);
                                                                                }
                                                                                ?></span></div>
                                                                    </div>

                                                                    <div class="pull-left wdth100 ordpend-line-dashed"></div>

                                                                    <div class="pull-left wdth100 lnehght40">Items (<?php echo count($result['item_detail']); ?>)</div>

                                                                    <div class="pull-left wdth100">

                                                                        <div class="pull-left wdth80" id="menuList">

            <?php foreach ($result['item_detail'] as $odata) { ?>
                                                                                <div class="pull-left wdth80 fdItem">
                                                                                    <div class="vegIcon"><i class="vg">&nbsp;</i> <?php echo $odata['name']; ?></div>
                                                                                    <div class="vegIcon pull-left">
                                                                                        <div class="text-left pull-left padleft20"><i class="fa fa-inr"></i> <?php echo $odata['price']; ?></div>
                                                                                        <div class="qty text-center pull-right"><?php echo $odata['qty']; ?></div>
                                                                                    </div>
                <?php
                if (count($odata['customization'])) {
                    foreach ($odata['customization'] as $cust) {
                        ?>


                                                                                            <div class="vegIcon">
                                                                                                <span style="font-weight: bold;"><?php echo $cust['name']; ?> - </span>
                                                                                                    <?php
                                                                                                    if (count($cust['options']) > 0) {
                                                                                                        $cc = 0;
                                                                                                        foreach ($cust['options'] as $opnm) {
                                                                                                            ++$cc;
                                                                                                            ?>
                                                                                                        <span><?php
                                                                            if ($opnm['option_name'] != "") {
                                                                                echo $opnm['option_name'];
                                                                                if (count($cust['options']) > $cc) {
                                                                                    echo ",";
                                                                                }
                                                                            }
                                                                            ?></span>
                            <?php }
                        } ?>
                                                                                            </div><?php }
                } ?>
                                                                                </div>
            <?php } ?>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="clearfix"></div>
                                                            </a>
                                                        </div>

                                                    </div>

                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div id="orderReason_staff" class='popUp' >
    <?php
    if (isset($response['orders_list']['list_of_staff_orders'])) {

        $cntr = 0;
        foreach ($response['orders_list']['list_of_staff_orders'] as $result) {

            ++$cntr;
            ?>  
                                                    <div class='containerOrder' id="orderBoxContainer_staff<?php echo $result['order_id']; ?>" style="display:none">
                                                        <div class="contact-box orderBx">
                                                            <a href="#">
                                                                <div class="col-sm-12">
                                                                    <div class="pull-left wdth100">
                                                                        <div class="pull-left text-left lnehght30">Order #<?php echo $result['order_id']; ?></div>
                                                                        <div class="pull-right text-right lnehght30 "><i class="fa fa-inr"></i> <?php echo $result['total_amount']; ?> /-</div>
                                                                    </div>

                                                                    <div class="pull-left wdth100 pdbtm">
                                                                        <div class="pull-left text-left lnehght24"><?php echo date('h:i a', ($result['order_time'])) . ', ' . date('d-M-Y', ($result['order_time'])); ?> <br /><i class="fa fa-map-marker"></i> <?php echo getOrderLocation($result['location']); ?><br /><i class="fa fa-user"></i> <?php
                                                                            if ($result['added_by'] == '1') {
                                                                                ?>
                                                                                <td class="center"><?php echo ucwords($result['staff_member_name']); ?> </td>
                                                                                <?php
                                                                            } else if ($result['added_by'] == '2') {
                                                                                ?>
                                                                                <td class="center"><?php echo ucwords($result['staff_member_name']); ?></td><?php } ?>
                                                                        </div>


                                                                        <div class="pull-right text-right lnehght24"><?php
                                                                            if ($result['payment_method'] == '1') {
                                                                                echo "Credit Purchase";
                                                                            } else if ($result['payment_method'] == '2') {
                                                                                echo "Cash On Delivery";
                                                                            } else if ($result['payment_method'] == '3') {
                                                                                echo "PayU";
                                                                            }
                                                                            ?><br /><i class="fa fa-clock-o"></i> <span class=""><?php
                                                                            $order_time = $result['order_time'];
                                                                            $complete_time = $result['completion_time'];
                                                                            if ($complete_time > 0) {
                                                                                echo $min = intval((($complete_time - $order_time) / 60));
                                                                                echo ":" . $sec = (($complete_time - $order_time) % 60);
                                                                            }
                                                                            ?></span></div>
                                                                    </div>

                                                                    <div class="pull-left wdth100 ordpend-line-dashed"></div>

                                                                    <div class="pull-left wdth100 lnehght40">Items (<?php echo count($result['item_detail']); ?>)</div>

                                                                    <div class="pull-left wdth100">

                                                                        <div class="pull-left wdth80" id="menuList">

            <?php foreach ($result['item_detail'] as $odata) { ?>
                                                                                <div class="pull-left wdth80 fdItem">
                                                                                    <div class="vegIcon"><i class="vg">&nbsp;</i> <?php echo $odata['name']; ?></div>
                                                                                    <div class="vegIcon pull-left">
                                                                                        <div class="text-left pull-left padleft20"><i class="fa fa-inr"></i> <?php echo $odata['price']; ?></div>
                                                                                        <div class="qty text-center pull-right"><?php echo $odata['qty']; ?></div>
                                                                                    </div>
                                                                                        <?php
                                                                                        if (count($odata['customization'])) {
                                                                                            foreach ($odata['customization'] as $cust) {
                                                                                                ?>


                                                                                            <div class="vegIcon">
                                                                                                <span style="font-weight: bold;"><?php echo $cust['name']; ?> - </span>
                                                                                                <?php
                                                                                                if (count($cust['options']) > 0) {
                                                                                                    $cc = 0;
                                                                                                    foreach ($cust['options'] as $opnm) {
                                                                                                        ++$cc;
                                                                                                        ?>
                                                                                                        <span><?php
                                                                                                        if ($opnm['option_name'] != "") {
                                                                                                            echo $opnm['option_name'];
                                                                                                            if (count($cust['options']) > $cc) {
                                                                                                                echo ",";
                                                                                                            }
                                                                                                        }
                                                                                                        ?></span>
                            <?php }
                        } ?>
                                                                                            </div><?php }
                } ?>
                                                                                </div>
                                                    <?php } ?>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="clearfix"></div>
                                                            </a>
                                                        </div>

                                                    </div>

            <?php
        }
    }
    ?>
                                        </div>
                                        <div id="orderReason_cust" class='popUp' >
    <?php
    if (isset($response['orders_list']['list_of_customer_orders'])) {

        $cntr = 0;
        foreach ($response['orders_list']['list_of_customer_orders'] as $result) {

            ++$cntr;
            ?>  
                                                    <div class='containerOrder' id="orderBoxContainer_cust<?php echo $result['order_id']; ?>" style="display:none">
                                                        <div class="contact-box orderBx">
                                                            <a href="#">
                                                                <div class="col-sm-12">
                                                                    <div class="pull-left wdth100">
                                                                        <div class="pull-left text-left lnehght30">Order #<?php echo $result['order_id']; ?></div>
                                                                        <div class="pull-right text-right lnehght30 "><i class="fa fa-inr"></i> <?php echo $result['total_amount']; ?> /-</div>
                                                                    </div>

                                                                    <div class="pull-left wdth100 pdbtm">
                                                                        <div class="pull-left text-left lnehght24"><?php echo date('h:i a', ($result['order_time'])) . ', ' . date('d-M-Y', ($result['order_time'])); ?> <br /><i class="fa fa-map-marker"></i> <?php echo getOrderLocation($result['location']); ?><br /><i class="fa fa-user"></i> <?php
                                                                            if ($result['added_by'] == '1') {
                                                                                ?>
                                                                                <td class="center"><?php echo ucwords($result['staff_member_name']); ?> </td>
                                                                                <?php
                                                                            } else if ($result['added_by'] == '2') {
                                                                                ?>
                                                                                <td class="center"><?php echo ucwords($result['staff_member_name']); ?></td><?php } ?>
                                                                        </div>


                                                                        <div class="pull-right text-right lnehght24"><?php
                                                                if ($result['payment_method'] == '1') {
                                                                    echo "Credit Purchase";
                                                                } else if ($result['payment_method'] == '2') {
                                                                    echo "Cash On Delivery";
                                                                } else if ($result['payment_method'] == '3') {
                                                                    echo "PayU";
                                                                }
                                                                ?><br /><i class="fa fa-clock-o"></i> <span class=""><?php
                                                                $order_time = $result['order_time'];
                                                                $complete_time = $result['completion_time'];
                                                                if ($complete_time > 0) {
                                                                    echo $min = intval((($complete_time - $order_time) / 60));
                                                                    echo ":" . $sec = (($complete_time - $order_time) % 60);
                                                                }
                                                                ?></span></div>
                                                                    </div>

                                                                    <div class="pull-left wdth100 ordpend-line-dashed"></div>

                                                                    <div class="pull-left wdth100 lnehght40">Items (<?php echo count($result['item_detail']); ?>)</div>

                                                                    <div class="pull-left wdth100">

                                                                        <div class="pull-left wdth80" id="menuList">

                                                                                    <?php foreach ($result['item_detail'] as $odata) { ?>
                                                                                <div class="pull-left wdth80 fdItem">
                                                                                    <div class="vegIcon"><i class="vg">&nbsp;</i> <?php echo $odata['name']; ?></div>
                                                                                    <div class="vegIcon pull-left">
                                                                                        <div class="text-left pull-left padleft20"><i class="fa fa-inr"></i> <?php echo $odata['price']; ?></div>
                                                                                        <div class="qty text-center pull-right"><?php echo $odata['qty']; ?></div>
                                                                                    </div>
                                                                                            <?php
                                                                                            if (count($odata['customization'])) {
                                                                                                foreach ($odata['customization'] as $cust) {
                                                                                                    ?>


                                                                                            <div class="vegIcon">
                                                                                                <span style="font-weight: bold;"><?php echo $cust['name']; ?> - </span>
                        <?php
                        if (count($cust['options']) > 0) {
                            $cc = 0;
                            foreach ($cust['options'] as $opnm) {
                                ++$cc;
                                ?>
                                                                                                        <span><?php
                                if ($opnm['option_name'] != "") {
                                    echo $opnm['option_name'];
                                    if (count($cust['options']) > $cc) {
                                        echo ",";
                                    }
                                }
                                ?></span>
                                                                    <?php }
                                                                } ?>
                                                                                            </div><?php }
                                } ?>
                                                                                </div>
            <?php } ?>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="clearfix"></div>
                                                            </a>
                                                        </div>

                                                    </div>

            <?php
        }
    }
    ?>
                                        </div>
<?php } ?>




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

        <script src="<?php echo config_item('base_url'); ?>assets/js/datepicker.js"></script>

        <script src="<?php echo config_item('base_url'); ?>assets/js/datatables.min.js"></script>
        <script type="text/javascript">
                                                                                function branchStaff(id = '')
                                                                                {
                                                                                    location.href = "<?php echo base_url(); ?>index.php/analytics/staffAnalytics/" + id;
                                                                                }
                                                                                $(function () {
                                                                                    $("#bars li .bar").each(function (key, bar) {
                                                                                        var percentage = $(this).data('percentage1');
                                                                                        $(this).animate({
                                                                                            'height': percentage + '%'
                                                                                        }, 1000);
                                                                                    });
                                                                                });
                                                                                $(function () {
                                                                                    $("#example1").DataTable();
                                                                                    $("#example2").DataTable();
                                                                                    $("#example3").DataTable();
                                                                                });

                                                                                function showPopUp(id)
                                                                                {
                                                                                    $('#fade').css('display', 'block');

                                                                                    var hh = $(document).height();

                                                                                    $(".black_overlay").css('height', hh);
                                                                                    $(".black_overlay").css('width', $(document).width());

                                                                                    var w = $(window).width() / 2;

                                                                                    var h = $(window).height() / 2;

                                                                                    var wh = 225; //$('.popUp').width()/2;
                                                                                    var he = $('.popUp').height() / 2;

                                                                                    var fw = w - wh;
                                                                                    var fh = h - he;

                                                                                    $('.popUp').css('right', fw);
                                                                                    $('.popUp').css('top', 10);
                                                                                    $("#orderBoxContainer" + id).css("display", "block");
                                                                                    // $("#orderCancelReason").css("display","block");

                                                                                }
                                                                                function showPopUp_staff(id)
                                                                                {
                                                                                    $('#fade').css('display', 'block');

                                                                                    var hh = $(document).height();

                                                                                    $(".black_overlay").css('height', hh);
                                                                                    $(".black_overlay").css('width', $(document).width());

                                                                                    var w = $(window).width() / 2;

                                                                                    var h = $(window).height() / 2;

                                                                                    var wh = 225; //$('.popUp').width()/2;
                                                                                    var he = $('.popUp').height() / 2;

                                                                                    var fw = w - wh;
                                                                                    var fh = h - he;

                                                                                    $('.popUp').css('right', fw);
                                                                                    $('.popUp').css('top', 10);
                                                                                    $("#orderBoxContainer_staff" + id).css("display", "block");
                                                                                    // $("#orderCancelReason").css("display","block");

                                                                                }
                                                                                function showPopUp_cust(id)
                                                                                {
                                                                                    $('#fade').css('display', 'block');

                                                                                    var hh = $(document).height();

                                                                                    $(".black_overlay").css('height', hh);
                                                                                    $(".black_overlay").css('width', $(document).width());

                                                                                    var w = $(window).width() / 2;

                                                                                    var h = $(window).height() / 2;

                                                                                    var wh = 225; //$('.popUp').width()/2;
                                                                                    var he = $('.popUp').height() / 2;

                                                                                    var fw = w - wh;
                                                                                    var fh = h - he;

                                                                                    $('.popUp').css('right', fw);
                                                                                    $('.popUp').css('top', 10);
                                                                                    $("#orderBoxContainer_cust" + id).css("display", "block");
                                                                                    // $("#orderCancelReason").css("display","block");

                                                                                }

                                                                                $(".black_overlay").click(function () {

                                                                                    $('#fade').css('display', 'none');
                                                                                    $('.popUp').attr('style', '');
                                                                                    $('.containerOrder').css('display', 'none');

                                                                                });

        </script>
    </body>
</html>
