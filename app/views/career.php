<?php

$this->load->view('include/header.php');

?>

<body>

<header class="row">
 <!-- Navigation Bar -->
      <nav  class="navbar navbar-default navbar-fixed-top navbar-inverse darken center-block" role="navigation" style="border-radius:8px;margin-top:6px;z-index:20000;">
        <!-- Brand and toggle get grouped for better mobile display -->
       <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
      <li class="thenavlist"><a  href="http://www.afewtaps.com"><img src="images/Home.png" class="img-responsive"></a></li>
      <li class="thenavlist"><a  style="padding-top:20px;"  href="#theseconddiv">Products</a></li>
      <li class="thenavlist"><a  style="padding-top:20px;" href="#howitworks" >How it works?</a></li>
      <li class="thenavlist"><a  style="padding-top:20px;" href="#atthemovies!">at the movies!</a></li>
      <li class="thenavlist"><a  style="padding-top:20px;" href="#business">Business</a></li>
      <li class="thenavlist"><a  style="padding-top:20px;" href="#theinstagram"><img src="images/instagram.png" alt="instagram" /></a></li>
      <li class="thenavlist"><a  style="padding-top:20px;" href="#getintouch">Get in Touch</a></li>
      </ul>
    </div>
  </div>
      </nav>
</header>

<div  style="padding-left:30px;padding-right:30px;padding-top:90px;padding-bottom:60px;background-image:url('images/career.jpg');color:white;background-size:cover;height:680px;">
<p class="text-center animated fadeInDown careertextsmall" style="font-size:40px; margin:0; letter-spacing: -0.024em;padding-top:20px;"><span class="theotherheadingsreponsive">Job Opportunity</span></p>
<p class="text-center animated fadeInDown" style="font-size:22px;letter-spacing: -0.024em;">Be known for the change</p>

<img src="images/star2.png" class="img-responsive center-block" style="padding-top:40px;padding-bottom:40px;"/>

<p class="text-center animated fadeInDown careertextsmall" style="font-size:40px; margin:0; letter-spacing: -0.024em;">We’re always in the hunt for talent…</p>

<p class="text-center animated fadeInDown" style="font-size:22px;letter-spacing: -0.024em;">Join us if you feel you can make a difference</p>

<p class="pull-right animated fadeInDown" style="font-size:20px;letter-spacing: -0.024em;padding-top:150px;">Send us your details at <span style="font-weight:bold;"><a href="mailto:info@afewtaps.com">info@afewtaps.com</a></span></p>


</div>




<?php


$this->load->view('include/footer.php');


?>
