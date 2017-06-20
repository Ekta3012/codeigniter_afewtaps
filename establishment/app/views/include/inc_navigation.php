<style>
    .fa-angle-right:before{content:"\f105"}

    .active > a > .fa-angle-right::before {
        content: "";
    }

    .fa-angle-right{float:right}
</style>

<?php
switch ($this->uri->segment(1)) {
    case 'order':
        switch ($this->uri->segment(2)) {
            case 'view':
                $home_active = 'active';
                break;
            case 'history':
                $history_active = 'active';
                break;
        }
        break;


    case 'establishment':
        $estab_active = 'active';
        switch ($this->uri->segment(2)) {
            case 'index':
                $estab_index = 'active';
                break;
            case 'view':
                $estab_view = 'active';
                break;
            case 'branch':
                $branch_view = 'active';
                break;
        }
        break;

    case 'staff':
        $real_time_active = 'active';
        $staff_active = 'active';
        switch ($this->uri->segment(2)) {
            case 'index':
                $staff_index = 'active';
                break;
            case 'view':
                $staff_view = 'active';
                break;
        }
        break;

    case 'coupon':
        $real_time_active = 'active';
        $coupon_active = 'active';
        switch ($this->uri->segment(2)) {
            case 'index':
                $coupon_index = 'active';
                break;
            case 'view':
                $coupon_view = 'active';
                break;
        }
        break;

    case 'payment':
        switch ($this->uri->segment(2)) {
            case 'index':
                $pay_active = 'active';
                break;
            case 'method':
                $real_time_active = 'active';
                $pay_method_active = 'active';
                break;

            case 'lastordernotification':
                $real_time_active = 'active';
                $last_order_active = 'active';
                break;
        }
        break;

    case 'merchant':
        switch ($this->uri->segment(2)) {
            case 'index':
                $merchant_active = 'active';
                break;
        }
        break;

    case 'profile':
        switch ($this->uri->segment(2)) {
            case 'changePassword':
                $changepwd_active = 'active';
                break;
        }
        break;

    case 'analytics':
        $analytics_active = 'active';
        switch ($this->uri->segment(2)) {
            case 'order':
                $order_active = 'active';
                break;

            case 'businessGenerated':
                $business_active = 'active';
                break;

            case 'staffAnalytics':
                $staff_analytics_active = 'active';
                break;
        }
        break;


    case 'admin':
        switch ($this->uri->segment(2)) {
            case 'thresholdView':
                $threshold_active = 'active';
                break;

            case 'location':
                $real_time_active = 'active';
                $location_active = 'active';
                break;
            case 'miscellaneous':
                $miscellaneous_active = 'active';
                break;
        }

    case 'floor':
        $floor_active = 'active';
        break;

    case 'negligent':
        $negligent_active = 'active';
        switch ($this->uri->segment(2)) {
            case 'index':
                $negligent_add_active = 'active';
                break;

            case 'view':
                $negligent_view_active = 'active';
                break;
        }
        break;

    case 'menu':
        $real_time_active = 'active';
        $menu_active = 'active';
        switch ($this->uri->segment(2)) {
            case 'index':
                $menu_add_active = 'active';
                break;

            case 'view':
                $menu_view_active = 'active';
                break;
        }
        break;

    case 'tax':
        $real_time_active = 'active';
        $tax_time_active = 'active';
        switch ($this->uri->segment(2)) {
            case 'index':
                $tax_add_active = 'active';
                break;

            case 'view':
                $tax_view_active = 'active';
                break;
        }
        break;

    case 'category':
    case 'cuisine':
        $main_cat_active = 'active';
        switch ($this->uri->segment(1)) {
            case 'category':
                switch ($this->uri->segment(2)) {
                    case 'index':
                        $category_add_active = 'active';
                        break;

                    case 'view':
                        $category_view_active = 'active';
                        break;
                }
                break;

            case 'cuisine':
                switch ($this->uri->segment(2)) {
                    case 'index':
                        $cuisine_add_active = 'active';
                        break;

                    case 'view':
                        $cuisine_view_active = 'active';
                        break;
                }
                break;
        }


    case 'rating':
        $analytics_active = 'active';
        $rating_tab_active = 'active';
        break;
}
?>
<style>
    .nav-third-level li a {padding-left:90px !important }
    .nav-second-level li a {padding:7px 10px 7px 57px !important }
</style>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">

            <li class="nav-header">
                <div class="dropdown profile-element"> 

                    <h3 style="text-align:center;color:#FFF;margin-top:0;font-weight:normal;font-size:23px;margin-bottom:20px">afewtaps</h3>

                    <span style="float:left">
                        <img alt="image" class="img-circle" width="40" src="<?php echo base_url(); ?>../uploads/user.png" />
                    </span>

                    <a data-toggle="dropdown" class="dropdown-toggle" href="#" style="text-align:left;">

                        <span style="padding-left:15px" class="clear"> 
                            <span class="block m-t-xs"> <strong class="font-bold">Welcome, </strong></span> 
                            <span style="color:#dfe4ed" class="text-muted text-xs block"><?php echo $this->session->userdata('name'); ?></span> 
                        </span>

                    </a>

                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="<?php echo site_url(); ?>/profile/logout">Logout</a></li>
                    </ul>

                </div>

                <div class="logo-element" style="background:#FFF;border:1px solid #F5F5F5">
                    <p><img src="<?php echo base_url(); ?>../uploads/logo.png" alt="afewtaps" width="35" /></p>
                </div>

            </li>

            <li class="<?php echo isset($home_active) ? "active" : ""; ?>">
                <a href="<?php echo site_url(); ?>/order/view"><i class="fa fa-home"></i> <span class="nav-label">Home</span></a>
            </li>

<!--            <li class="<?php echo isset($history_active) ? "active" : ""; ?>">
                <a href="<?php echo site_url(); ?>/order/history"><i class="fa fa-list-alt"></i> <span class="nav-label">Order History</span></a>
            </li>-->

            <li class="<?php echo ($result['active_tab']=='orders')?"active":"";?>">
                <a href="#"><i class="fa fa-list-alt"></i> <span class="nav-label">Order History</span><span class="fa fa-angle-right"></span></a>
                <ul class="nav nav-second-level collapse">
<li class="<?php echo ($result['active_li']=='all_orders')?"active":"";?>"><a href="<?php echo site_url() . '/order/history';?>">All Orders</a></li>
<li class="<?php echo ($result['active_li']=='staff_order_history')?"active":"";?>"><a href="<?php echo site_url() . '/order/staff_order_history';?>">Staff Orders</a></li>
<li class="<?php echo ($result['active_li']=='customer_order_history')?"active":"";?>"><a href="<?php echo site_url() . '/order/customer_order_history';?>">Customer Orders</a></li>

                </ul>
            </li>
            <li class="<?php echo isset($estab_active) ? "active" : ""; ?>">
                <a href="#"><i class="fa fa-cutlery"></i> <span class="nav-label">Establishment Info</span><span class="fa fa-angle-right"></span></a>
                <ul class="nav nav-second-level collapse">

<?php
$uId = $this->session->userdata('id');
$flag = getUserEstab($uId);
if ($flag == 0) {
    $estatus = isset($estab_index) ? "active" : "";
    echo '<li class="' . $estatus . '"><a href="' . site_url() . '/establishment/index">Add Establishments</a></li>';
} else {
    $estatus = isset($estab_view) ? "active" : "";
    //echo '<li class="">Add Establishments</li>';
    echo '<li class="' . $estatus . '"><a href="' . site_url() . '/establishment/view">View Establishments</a></li>';
}

//$estatus = isset($estab_index) ? "active" : "";
// echo '<li class="'.$estatus.'"><a href="'.site_url().'/establishment/index">Add Establishments</a></li>';
//$estatus = isset($estab_view) ? "active" : "";
//echo '<li class="'.$estatus.'"><a href="'.site_url().'/establishment/view">View Establishments</a></li>';
?>

                </ul>
            </li>

<!-- <li class="<?php echo isset($main_cat_active) ? "active" : ""; ?>">
<a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Category</span><span class="fa arrow"></span></a>
<ul class="nav nav-second-level collapse">
<li class="<?php echo isset($category_add_active) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/category/index">Add Category</a></li>
                <li class="<?php echo isset($category_view_active) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/category/view">View Category</a></li>
                
                <li class="<?php echo isset($cuisine_add_active) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/cuisine/index">Add Cuisine</a></li>
                <li class="<?php echo isset($cuisine_view_active) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/cuisine/view">View Cuisine</a></li> 
                
</ul>
</li> -->


                        <!-- <li class="<?php echo isset($analytics_active) ? "active" : ""; ?>">
            <a class="<?php echo isset($analytics_active) ? "active" : ""; ?>" href="<?php echo site_url(); ?>/analytics/staffAnalytics"><i class="fa fa-dashboard"></i> <span class="nav-label">Analytics</span></a>
        </li> -->

            <li class="<?php echo isset($analytics_active) ? "active" : ""; ?>">
<!-- <a class="<?php echo isset($analytics_active) ? "active" : ""; ?>" href="<?php echo site_url(); ?>/analytics/staffAnalytics"><i class="fa fa-dashboard"></i> <span class="nav-label">Analytics</span></a> -->

                <a href="#" class="<?php echo isset($analytics_active) ? "active" : ""; ?>"><i class="fa fa-dashboard"></i> <span class="nav-label">Analytics</span><span class="fa fa-angle-right"></span></a>

                <ul class="nav nav-second-level collapse">
                    <li class="<?php echo isset($order_active) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/analytics/order">No Of Orders</a></li>

                    <li class="<?php echo isset($business_active) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/analytics/businessGenerated">Business Generated</a></li>

<!-- <li class="<?php echo isset($estab_view) ? "active" : ""; ?>"><a href="#">Negligent Ratings</a></li> -->

                    <li class="<?php echo isset($staff_analytics_active) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/analytics/staffAnalytics">Staff Analytics</a></li>

                    <li class="<?php echo isset($rating_tab_active) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/rating/index">Negligent Ratings</a></li>

                </ul>
            </li>

<!-- <li class="<?php echo isset($analytics_active) ? "active" : ""; ?>">
<a href="#"><i class="fa fa-area-chart"></i> <span class="nav-label">Analytics</span><span class="fa arrow"></span></a>
<ul class="nav nav-second-level collapse">
<li class="<?php echo isset($order_active) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/analytics/order">No Of Orders</a></li>
                
                <li class="<?php echo isset($business_active) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/analytics/businessGenerated">Business Generated</a></li>
                
<li class=""><a href="#">Negligent Ratings</a></li>
                
                <li class=""><a href="<?php echo site_url(); ?>/analytics/staffAnalytics">Staff Analytics</a></li>
                
</ul>
</li>-->

            <li class="<?php echo isset($real_time_active) ? "active" : ""; ?>">
                <a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Real Time Orders</span><span class="fa fa-angle-right"></span></a>
                <ul class="nav nav-second-level collapse">

<!-- <li class="<?php echo isset($order_active) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/menu/index">Menu</a></li> -->

                    <li class="<?php echo isset($menu_active) ? "active" : ""; ?>">
                        <a href="#"><i class="fa fa-list"></i> <span class="nav-label">Menu</span><span class="fa fa-angle-right"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li class="<?php echo isset($menu_add_active) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/menu/index">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add Menu Items</a></li>
                            <li class="<?php echo isset($menu_view_active) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/menu/view">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View Menu Items</a></li>
                        </ul>
                    </li>


                    <li class="<?php echo isset($tax_time_active) ? "active" : ""; ?>">
                        <a href="#"><i class="fa fa-inr"></i> <span class="nav-label">Tax</span><span class="fa fa-angle-right"></span></a>
                        <ul class="nav nav-third-level collapse">
                            <li class="<?php echo isset($tax_add_active) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/tax/index">&nbsp;&nbsp;&nbsp;Add Tax</a></li>
                            <li class="<?php echo isset($tax_view_active) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/tax/view">&nbsp;&nbsp;&nbsp;View Tax</a></li>
                        </ul>
                    </li>

                    <li class="<?php echo isset($location_active) ? "active" : ""; ?>"><a class="" href="<?php echo site_url(); ?>/admin/location"><i class="fa fa-location-arrow"></i> <span class="nav-label">Location</span></a></li>

                    <li class="<?php echo isset($threshold_active) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/admin/thresholdView"><i class="fa fa-exclamation-circle"></i> <span class="nav-label">Threshold limit</span></a></li>


                    <li class="<?php echo isset($staff_active) ? "active" : ""; ?>">
                        <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Staff Member</span><span class="fa fa-angle-right"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li class="<?php echo isset($staff_index) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/staff/index">&nbsp;&nbsp;&nbsp;Add Staff Member</a></li>
                            <li class="<?php echo isset($staff_view) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/staff/view">&nbsp;&nbsp;&nbsp;View Staff Member</a></li>
                        </ul>
                    </li>


<!--<li class="<?php echo isset($pay_method_active) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/payment/method">Payment</a></li> -->

                    <li class="<?php echo isset($coupon_active) ? "active" : ""; ?>">
                        <a href="#"><i class="fa fa-newspaper-o"></i> <span class="nav-label">Coupon</span><span class="fa fa-angle-right"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li class="<?php echo isset($coupon_index) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/coupon/index">&nbsp;&nbsp;&nbsp;&nbsp;Add Coupon</a></li>
                            <li class="<?php echo isset($coupon_view) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/coupon/view">&nbsp;&nbsp;&nbsp;&nbsp;View Coupon</a></li>
                        </ul>
                    </li>

                    <li class="<?php echo isset($last_order_active) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/payment/lastordernotification"><i class="fa fa-clock-o"></i> <span class="nav-label">Last Order Notification</span></a></li>

                    <li class="<?php echo isset($pay_method_active) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/payment/method"><i class="fa fa-cc-mastercard"></i> <span class="nav-label">Payment Method</span></a></li>


                </ul>
            </li>

            <li class="<?php echo isset($pay_active) ? "active" : ""; ?>">
                <a href="<?php echo site_url(); ?>/payment/index"><i class="fa fa-credit-card"></i> <span class="nav-label">Payment Settlement</span></a>
            </li>

            <li class="<?php echo isset($negligent_active) ? "active" : ""; ?>">
                <a href="#"><i class="fa fa-scissors"></i> <span class="nav-label">Negligent Marking</span><span class="fa fa-angle-right"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="<?php echo isset($negligent_add_active) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/negligent/index">Add Negligent Marking</a></li>
                    <li class="<?php echo isset($negligent_view_active) ? "active" : ""; ?>"><a href="<?php echo site_url(); ?>/negligent/view">View Negligent Marking</a></li>
                </ul>
            </li>

            <li class="<?php echo isset($merchant_active) ? "active" : ""; ?>">
                <a href="<?php echo site_url(); ?>/merchant/index"><i class="fa fa-info"></i> <span class="nav-label">Merchant Information</span></a>
            </li>


            <li class="<?php echo isset($miscellaneous_active) ? "active" : ""; ?>">
                <a href="<?php echo site_url(); ?>/admin/miscellaneous"><i class="fa fa-info-circle"></i> <span class="nav-label">Miscellaneous</span></a>
            </li>

            <li class="<?php echo isset($changepwd_active) ? "active" : ""; ?>">
                <a href="<?php echo site_url(); ?>/profile/changePassword"><i class="fa fa-key"></i> <span class="nav-label">Change Password</span></a>
            </li>

            <li class="">
                <a href="<?php echo site_url(); ?>/profile/logout"><i class="fa fa-power-off"></i> <span class="nav-label">Log Out</span></a>
            </li>


        </ul>

    </div>
</nav>