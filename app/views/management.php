<?php

$this->load->view('include/header.php');

?>

<body>
<div class="container-fluid">
    <div id="management" style="text-align: center; padding:2%;">
      <h1 style="font-size: 39px;">Management Dashboard</h1>
      <h4>View. Control. Edit. Supervise.</h4>
      <p style="font-size: 14px;">A dashboard to handle and control on-going operations.</p>
      <img src="images/pc.png" class="img-responsive" style="height: 200px; margin:3%  auto;">
      <p>View real-time operations, orders, history, payments settlements and cancelled orders.</p>
      <p>Modify menu items, pricing, descriptions, staff employed, taxes.</p>
      <p>Set Restaurant Threshold Limit</p>
      <p>Enter discounts/offers for customers</p>
      <p>Business Analytics</p>
      <p>Floor Performance (Staff Analytics)</p>    
    </div>  
    <div class="row footer">
      <div class="col-sm-6" style="text-align: left; ">
        <h4><b>ABOUT US</b></h4>
        <p>A startup, aiming to create</p>
        <p>disruption in the food service technology space.</p>
        <p>We pledge to make food service <b>world class...</b></p>
      </div>
      <div class="col-sm-6" style="text-align: right;">
        <ul style="list-style: none;">
              <li><a href="{!! url('/career'); !!}" style="text-decoration: none; color: #fff;">Career</a></li>
              <li><a href="{!! url('/faq'); !!}" style="text-decoration: none; color: #fff;">FAQ</li>
              <li><a href="{!! url('/blog'); !!}" style="text-decoration: none; color: #fff;">Blog</a></li>
              <li><a href="{!! url('/feedback'); !!}" style="text-decoration: none; color: #fff;"><li><a href="{!! url('/privacy'); !!}" style="text-decoration: none; color: #fff;">Privacy</a></li>
                              <li><a href="{!! url('/terms'); !!}" style="text-decoration: none; color: #fff;">Terms</a></li>
            </ul>
        <p style="font-size: 13px;">Copyright © 2017 Think Different Technologies (P) Ltd</p>
      </div>
    </div>  
    <?php


$this->load->view('include/footer.php');


?>
  </div>  


