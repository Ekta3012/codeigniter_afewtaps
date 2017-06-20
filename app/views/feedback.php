<!-- header and navbar starting -->

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

<!-- end of header and navbar -->

<!-- middle content -->
<div class="thefeedbackpage">


<p class="text-center" style="">
 <img style="vertical-align:middle;width:135px;" src="images/feedchat.png">
                 <span style="text-align:center;font-size:24px;font-weight:bold;vertical-align:middle;position: relative;left: -32px;">Feedback</span>
</p>				

<p style="text-align:center;font-size:22px;">We value your feedback,both positive and negative.<br> Share your experience with <strong>afewtaps</strong>. </p>

<?php echo form_open(); ?>

  
  <div class="form-group">
  
    <input type="text" class="form-control center-block animate fadeInDown" id="pwd" style="width:25%;border:none;font-size:16px;background:none;text-align:center;margin-top: 34px; border-bottom:2px solid #fff; padding:26px;color:white;" placeholder="Name">
  
  </div>
    <div class="form-group">
   
    <input type="email" class="form-control center-block animate fadeInDown" id="te" style="width:25%;border:none;font-size:16px;background:none;text-align:center;margin-top: 34px; border-bottom:2px solid #fff; padding:26px;color:white;" placeholder="Email ID">
  </div>
  
    <div class="form-group">

    <input type="text" class="form-control center-block animate fadeInDown" id="text" style="width:25%;border:none;font-size:16px;background:none;text-align:center;margin-top: 34px; border-bottom:2px solid #fff; padding:26px;color:white;" placeholder="Your Feedback">
  </div>
  
  <button type="submit" class="btn btn-default center-block animate fadeInDown" style="width:auto;margin-top:34px;background-color:#8eac7a;background-image:none;padding:12px;color:white;border-radius:8px; border: none; letter-spacing: .1em;">SUBMIT</button>
  
  <?php echo form_close(); ?>





</form>






</div>
<!-- end of middle content -->


<!-- footer -->
<?php


$this->load->view('include/footer.php');


?>

<!-- end of footer -->