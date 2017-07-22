<!-- header and navbar starting -->

<?php

$this->load->view('include/header.php');

?>




<body>
<div class="container-fluid Feedback" style="background-size: 100% 100%;">
    <div class="layer_white" style="padding-bottom: 0;">
      <img src="images/chat.png" class="img-responsive" style="margin: auto; display: inline; padding-right: 1%; height: 50px;">
      <h1 style="display: inline; vertical-align: middle;">Feedback</h1>
      <p style="font-size: 19px; padding: 1% 0%;">
        We value your feedback, both positive and negative.<br>
        Share your experience with afewtaps.
      </p>
      <div id="feedback_form" class="container">
        <?php echo form_open(); ?>

  
  <div class="form-group">
  
    <input type="text" class="form-control center-block animate fadeInDown" id="pwd" style="border:none;font-size:16px;background:none;text-align:center;margin-top: 34px; border-bottom:2px solid #fff; padding:26px;color:white;" placeholder="Name">
  
  </div>
    <div class="form-group">
   
    <input type="email" class="form-control center-block animate fadeInDown" id="te" style="border:none;font-size:16px;background:none;text-align:center;margin-top: 34px; border-bottom:2px solid #fff; padding:26px;color:white;" placeholder="Email ID">
  </div>
  
    <div class="form-group">

    <input type="text" class="form-control center-block animate fadeInDown" id="text" style="border:none;font-size:16px;background:none;text-align:center;margin-top: 34px; border-bottom:2px solid #fff; padding:26px;color:white;" placeholder="Your Feedback">
  </div>
  
  <button type="submit" class="btn btn-default center-block animate fadeInDown" style="width:auto;margin-top:34px;background-color:#8eac7a;background-image:none;padding:12px;color:white;border-radius:8px; border: none; letter-spacing: .1em;">SUBMIT</button>
  
  <?php echo form_close(); ?>
      </div>
    </div>
   
  </div>



<!-- footer -->
<?php


$this->load->view('include/footer.php');


?>

<!-- end of footer -->