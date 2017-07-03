<?php

$this->load->view('include/header.php');

?>

<style>
	.form-group{margin-bottom:15px}

	label {
		display: inline-block;
		font-weight: 700;
		max-width: 100%;
		color:#333;
	}

	.form-control, .single-line 
	{
		background-color: #ffffff;
		background-image: none;
		border: 1px solid #e5e6e7;
		border-radius: 1px;
		color: #333;
		display: block;
		font-size: 13px;
		padding: 6px 12px;
		transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
		width: 75%;
	}
	
	.msginfo{padding:5px 10px;color:#333}
	.success{color:#3c763d}
	.error{color:#a94442}
	.fa{
		font-size: 30px;
		color: #000;
	}	
	.item_box{
		height:500px;
	}

	.photo-thumb{
		width:100%;
		height:auto;
		float:left; 
		border: thin solid #d1d1d1;
		margin:0 1em .5em 0;
		float:left; 
	}

</style>

<body style="font-family:'Myriad Pro Light' !important; letter-spacing: 1.5px;">
	<?php
	$this->load->library('session');
	if ($this->session->flashdata('success'))
		echo '<p class="text-center" style="line-height:20px;height:20px">'.$this->session->flashdata('success').'</p>';
	?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-5 col-xs-6 col-lg-5" style="padding-top: 15px;">
				<img src="images/landing.png" class="img-responsive landing_img" style="height:650px; width: 520px; border-radius: 10px; ">
			</div>
			<div class="col-sm-7 col-xs-6 col-lg-7"> 
				<nav class="navbar navbar-default" style="background-image: none !important; box-shadow: none !important;background-color: transparent !important; 	border-color:transparent !important; font-size: 16px;letter-spacing: 1px; padding-top: 2%;">
					<div class="container-fluid" style="padding-right: 0px; padding-left: 0px;">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span> 
							</button>
							<a class="navbar-brand" href="homepage.html"><img src="images/logob.png" class="img-responsive" width="55px" ></a>
						</div>
						<div class="collapse navbar-collapse" id="myNavbar" style="padding-right: 0px; padding-left: 0px;">
							<ul class="nav navbar-nav" style="padding-left: 2%;">
								<li class="dropdown" >
									<a href="#">Products <i class="fa fa-circle dot" aria-hidden="true" style="font-size: 6px !important; display: block; padding-top: 4%; text-align: center;"></i></a>                 
									<ul class="dropdown-content" style="padding-left: 10px;">
										<li><img src="images/iphone.png" style="height: 35px; " >Customer App</li>
										<li ><img src="images/ipad.png" style="height: 35px; " ><img src="images/iphone.png" style="width: 35px; " >Service App</li>
										<li><img src="images/pos.png" style="height: 35px; " >POS Integration</li>
										<li><img src="images/web_d.png" style="height: 35px; " >Web Dashboard</li>
									</ul>
								</li>
								<li><a href="#movies">at the movies!</a></li>
								<li><a href="#how">How it works?</a></li>
								<li><a href="#buisness">Buisness</a></li>
								<li><a href="https://www.instagram.com/afewtaps/" style="padding:11px 17px;"><img src="images/insta.png" class="img-responsive" width="25px"></a></li>
								<li><a href="mailto:info@afewtaps.com" style="padding:11px 17px;"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></li>
								<li><a href="#" style="padding:11px 17px;" data-toggle="modal" data-target="#myModal"><i class="fa fa-user" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
				</nav> 
				
     <div class="modal fade" id="myModal" role="dialog">
     	<div class="modal-dialog">

     		<!-- Modal content-->
     		<div class="modal-content">
     			<div class="modal-header" style="background-color:#161616;">
     				<button type="button" class="close" data-dismiss="modal">x</button>
     				<h4 class="modal-title" style="color:#f6f6f6;font-weight:bold;">Sign In Here</h4>
     			</div>
     			<div class="modal-body">
     				<div class="conatiner">
     					<div class="row">
     						<div class="col-md-6">
     							<img src="images/1484154117_admin.png" class="img-responsive center-block">
     							<p style="text-align:center;color:black;">Admin Dashboard</p>
     							<p style="text-align:center;color:#003d59;"><a target="_blank" href="http://afewtaps.com/admin/">Login</a></p>

     						</div>
     						<div class="col-md-6">
     							<img src="images/1484154218_ic_local_restaurant_48px.png" class="img-responsive center-block">
     							<p style="text-align:center;color:black;">Establishment Dashboard</p>
     							<p style="text-align:center;color:#003d59;"><a target="_blank" href="http://afewtaps.com/establishment/">Login</a></p>   							

     						</div>
     					</div>
     					<div class="row">
     						<form action="#" id="signup" class="form-horizontal" method="post" accept-charset="utf-8" onsubmit="return validation();">

     							<p class="text-center" style="color:#333"><strong>New Establishment? Signup here</strong></p>
     							<p class="msginfo" id="msginfo"></p>

     							<div class="form-group"><label class="col-sm-4 control-label">Name</label>
     								<div class="col-sm-8">
     									<input name="name" value=""  class="form-control" placeholder="Name" type="text" id="name" autocomplete="off" />
     								</div>
     							</div>

     							<div class="form-group"><label class="col-sm-4 control-label">Email</label>
     								<div class="col-sm-8">
     									<input name="email" value="" class="form-control" placeholder="Email" type="text" id="email" autocomplete="off" />
     								</div>
     							</div>

     							<div class="form-group"><label class="col-sm-4 control-label">Mobile No</label>
     								<div class="col-sm-8">
     									<input name="mobile" value="" class="form-control" placeholder="Mobile No" type="text" id="mobile" autocomplete="off" />
     								</div>
     							</div>

     							<div class="form-group"><label class="col-sm-4 control-label">Address</label>
     								<div class="col-sm-8">
     									<textarea name="address" value="" class="form-control" placeholder="Address" id="address" autocomplete="off"></textarea>
     								</div>
     							</div>

     							<div class="form-group"><label class="col-sm-4 control-label">Captcha</label>
     								<div class="col-sm-8" id="captchacontainer">
     									<?php echo $cap['image']; ?>
     								</div>
     							</div>

     							<div class="form-group"><label class="col-sm-4 control-label">&nbsp;</label>
     								<div class="col-sm-8">
     									<input name="captcha" value="" class="form-control" placeholder="Type number shown in above" type="text" id="captcha" autocomplete="off" />
     								</div>
     							</div>

     							<div class="form-group">
     								<div class="col-sm-4 col-sm-offset-4">
     									<button type="submit" class="btn btn-primary">Submit</button>
     								</div>
     							</div>
     						</form>
     					</div>
     				</div>
     			</div>
     			<div class="modal-footer" style="border-top:0px;background-color:#f6f6f6;">
     				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
     			</div>
     		</div>
     	</div>
     </div>
     <div class="modal fade" id="mySignUp" role="dialog">
     	<div class="modal-dialog">
     		<!-- Modal content-->
     		<div class="modal-content">
     			<div class="modal-header" style="background-color:#161616;">
     				<button type="button" class="close" data-dismiss="modal">&times;</button>
     				<h4 class="modal-title" style="color:#f6f6f6;font-weight:bold;">Create Account</h4>
     			</div>
     			<div class="modal-body">
     				<div class="conatiner">
     					<div class="row">

     						<?php //echo form_open("#", array("id" => "signup", "class" => "form-horizontal", "method" => "post", "accept-charset" => "utf-8", "onsubmit" => "return validation()")); ?>

     						<form action="#" id="signup" class="form-horizontal" method="post" accept-charset="utf-8" onsubmit="return validation()">

     							<input id="csrf_token" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display:none;" type="hidden" />

     							<p class="msginfo" id="msginfo"></p>

     							<div class="form-group"><label class="col-sm-4 control-label">Name</label>
     								<div class="col-sm-8">
     									<input name="name" value="" required="" class="form-control" placeholder="Name" type="text">
     								</div>
     							</div>

     							<div class="form-group"><label class="col-sm-4 control-label">Email</label>
     								<div class="col-sm-8">
     									<input name="email" value="" required="" class="form-control" placeholder="Email" type="email">
     								</div>
     							</div>

							<!-- <div class="form-group"><label class="col-sm-4 control-label">Password</label>
								<div class="col-sm-8">
								   <input name="password" value="" required class="form-control" placeholder="Password" type="password">
								</div>
							</div> -->
							
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-4">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>
						
					</div>
				</div>
			</div>
			<div class="modal-footer" style="border-top:0px;background-color:#f6f6f6;">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	          
		
   <!--<button class="btn Store"><img src="images/apple.png">&nbsp; &nbsp; App Store</button>
   <button class="btn Store" style="display: inline; margin-top: 0px;"><img src="images/android.png">&nbsp; &nbsp; Play Store</button> --></div> </div>
   <p id="time">
               <script type="text/javascript">
                    var date = new Date();  
                    var options = {  
                         month: "short",  
                         day: "numeric", hour: "2-digit", minute: "2-digit"  
                    };  
                    document.write(date.toLocaleTimeString("en-us", options));  
               </script>
          </p>            
          <p class="header_home">afewtaps app </p>
          <h2 style="margin-top: 1%">Hello, welcome to afewtaps.</h2> 
          <ul class="mac">
               <li style="margin-left: -14px;"><img src="images/ipad.png"  class="img-responsive ipad" ></li>
               <li ><img src="images/iphone.png" class="img-responsive iphone"></li>
          </ul>   
          <h4 style="clear: left; padding-top: 3%;"><span style="font-family: myriad-pro-condensed, sans-serif;">Take</span> Orders. <span style="font-family: myriad-pro-condensed, sans-serif;">Place</span> Orders.</h4>   
          <hr class="hr_top">                             
          <p class="section"> Order Taking and Customer Ordering services </p>
   <img src="images/appstore.png" class="img-responsive" style="height: 45px;  margin-top: 7%; display: inline;">
   <img src="images/downarrow.png" style="float: right; height: 25px; display: inline; margin-top: 9%; padding-right: 2%;">
         
     
     </div>
     </div>
     <div class="sec2">
     	<img src="images/bookmark.png" class="img-responsive bookmark">
     	<p>
     		Every word class city, needs a world class outlet, <br>and every world class outlet, needs to serve with afewtaps.
     	</p>
     	<hr style="background-color: #000; height: 2px; width: 45%;">
     	<p>
     		Making restaurant service <b>world class...</b>
     	</p>
     	<h4 style="padding-top: 23%; font-weight: bolder;">Products <img src="images/downarrow.png" class="img-responsive" width="20px" height="20px" style="display: inline; margin-left: 7px; height: 25px;"></h4>
     </div>
     <div class="row">            
     	<div class="col-lg-6 col-sm-12 col-xs-12 sec3_1" style="padding-left: 0px; padding-right: 0px;">
     		<div id="sec3_p1">
     			<h2 style="padding-top: 43%;"><b>Placing Orders</b></h2>
     			<h2 style="margin: 0; font-weight: bolder;"><b>#smartphoneordering</b></h2>
     		</div>
     		<div id="sec3_p1_h" style="display: none; ">
     			<div class="sec3_layer" style="border-radius: 15px; padding: 46% 0%;">
     				<img src="images/mac_silver.png" class="img-responsive" style=" margin:0 auto; height: 36px; margin-bottom: 3%;">
     				<h4 >Place orders at your own convenience.</h4>
     				<h4 style="margin: 0; ">#notforhomedelivery</h4>                    
     				<p style="font-size: 18px; padding-top: 6%;">
     					<a href="<?php echo site_url(); ?>/welcome/userapp" style="text-decoration: none; color: #fff; ">Learn More <i class="fa fa-angle-right" aria-hidden="true" style="color: #fff; padding-left: 1%; font-size: 18px;"></i></a>

     				</p>
     			</div>
     		</div>
     	</div>

     	<div class="col-lg-6 col-sm-12 col-xs-12 sec3_2" style="padding-left: 0px; padding-right: 0px;">
     		<div id="sec3_p2">                  
     			<h2  style="padding-top: 43%; font-weight: bolder;"><b>Taking Orders *</b></h2>
     			<h2 style="margin: 0; "><b>#handheldPOS</b></h2>
     			<h4 style="margin-top: 39%; color: #fff; font-weight: bolder;">
     				<b>* for restaurants</b>
     			</h4>
     		</div>
     		<div id="sec3_p2_h" style="display: none;">
     			<div class="sec3_layer" style="border-radius: 15px; padding: 46% 0%;">
     				<img src="images/android_silver.png" class="img-responsive" style=" margin: 0 auto; height: 36px; margin-bottom: 3%;">
     				<h4 style="line-height: 24px;">Just <b>type and enter</b> to take customer orders.<br>
     					Its lightning fast and connected to your POS.<br>
     					All you need is a good hand at typing.</h4>
     					<p style="font-size: 18px; padding-top: 6%;">
     						<a href="<?php echo site_url(); ?>/welcome/servapp" style="text-decoration: none; color: #fff; ">Learn More <i class="fa fa-angle-right" style="color: #fff; padding-left: 1%; font-size: 18px;" aria-hidden="true"></i></a>
     					</p>
     				</div>
     			</div>
     		</div>

     	</div>
     	<div class="row" style="background-color: #778899; ">
     		<div class="col-sm-1 col-xs-2 add">                         
     			<p class="vertical-text p1"><b></span>Add-ons for restaurants</b></p>
     			<!-- <span class="glyphicon glyphicon-star star-bottom"> -->
     		</div>          
     		<div class="col-sm-11 col-xs-10" style=" text-align: center; font-size: 16px; background-color: #fff; padding-left: 0px; padding-right: 0px;">
     			<div>
     				<img src="images/calc.png" style="width: 100px; height: 100px; margin-top: 4%;">
     				<div class="responsive_text" >Connecting our services with the Point of Sale software,<p>for one-tap system feeding and ticket generation.</p></div>
     			</div>
     			<div style="background-color: #E3E7EA; padding: 2%; ">
     				<img src="images/system.png" style="height: 100px;">
     				<h2 class="dashboard" style="">afewtaps - Web Dashboard </h2>
     				<h4 class="handling">Handling operations. Works on any browser.</h4>
     				<a href="<?php echo site_url(); ?>/welcome/management"><img src="images/arrow_right.png" class="img-responsive" style="margin: 1% auto;"></a>
     			</div>
     		</div>
     	</div>  
     	<img src="images/star.png" class=" star_img" style="z-index: 1; position: absolute; margin-top: -35px;"> 
     	<div class="row" style="background-color: #778899;">
     		<div class="col-sm-1 col-xs-2 add">
     			<p class="vertical-text p2"><b></span> Add-ons for Customers</b></p>
     		</div>
     		<div class="col-sm-11 col-xs-10 customers" style="padding-left: 0px; padding-right: 0px;" >
     			<div>
     				<img src="images/hotcup.png" class="img-responsive" style="margin: 0% auto; display: inline; height: 50px;">
     				<img src="images/cup.png" class="img-responsive" style="margin: 0% auto; display: inline; height: 50px;">
     				<p style="font-size: 18px; padding-top: 2%;">My Personal Menu</p>
     			</div>
     			<div style="background-color: #EBEEF0;">
     				<img src="images/iphone.png" class="img-responsive" style="margin: 0% auto; height: 50px;">
     				<p style="font-size: 18px; padding-top: 2%;">Sublime Interface</p>
     			</div>
     			<div>
     				<img src="images/recycle.png" class="img-responsive" style="margin: 0% auto; height: 50px;">
     				<p style="font-size: 18px; padding-top: 2%;">Repeat Orders, quite handy for drinks.</p>
     			</div>
     		</div>
     	</div>
     	<div class="row android">
     		<h2>An android based app, to speed up your service.</h2>
     		<img src="images/iphone.png" class="img-responsive" style="margin:auto; margin-top: 8%; ">
     		<h3>#serviceapp</h3>
     		<p>Handle floor operations in the most efficient manner .</p>
     	</div>

     	<div class="row how" id="how">
     		<h2>How it works?</h2>
     		<img src="images/clipboard.png" class="img-responsive" style="margin: auto; height: 100px; margin-top: 3%;"> 
     		<p >
     			We place beautifully designed cards on the tables in order to mark areas of the restaurant. <br>This way, the customer knows their Table No.
     		</p>
     		<h3 style="padding-top: 4%;">
     			The Future - <b>Table Marking</b>
     		</h3>
     		<i class="fa fa-angle-down" aria-hidden="true"></i>
     		<div class="row" style="padding-top: 2%;">
     			<div class="col-sm-4 col-xs-4">         
     			</div>
     			<div class="col-sm-4 col-xs-4" style="padding-right: 0px;">
     				<img src="images/date.png" class="img-responsive" style="height: 120px; margin-right: 12%; display: inline;">
     				<img src="images/arrow_right.png" class="img-responsive" style="display: inline;">
     			</div>
     			<div class="col-sm-2 col-xs-2 rec">
     				<p><b>12</b></p>                
     			</div>
     			<div class="col-sm-2 col-xs-2">         
     			</div>
     		</div>
     	</div>
     </div>
    	
<div class="" style="background-color: #000; color: #fff; padding: 7%; text-align: center; font-size: 20px;">
	“What we propose to restaurants, is having a mix of both worlds (Manual & <br>Smartphone ordering) for the customer.”
</div>
<div class="movies" id="movies">
	<img src="images/round_logo.png" class="img-responsive" style="width: 65px; border-radius: 100%; margin: auto; border: 2px solid #e2e2e2;
	background-color: #e2e2e2;">
	<p style="padding-top: 2%;">Other industries where afewtaps would be a natural fit:</p>
	<h2>at the movies!</h2>
	<img src="images/movies.png" class="img-responsive" style="height: 200px; margin: auto;">
	<p style="padding-top: 2%;">Place orders at the comforts of your seat, while watching movies.</p>
	<p ><i class="fa fa-star" style="font-size: 20px;" aria-hidden="true"></i></p>
	<p>Have multiple POS counters, to handle more customers during interval.</p>
	<div class="container" style="padding: 2%; background-color: #000; width: 70%; border-radius: 5px; margin-top: 2%; font-size: 18px; color: #fff;">
		<b>Email us</b> your interest and we’ll propose how our product can work best for you.
	</div>
</div>
<div class="buisness" id="buisness">
	<div class="layer">
		<img src="images/bp.png" class="img-responsive" style="margin: auto; height: 70px">
		<h1 style="text-align: center; ">afewtaps - Business</h1>
		<p style="text-align: center;  font-size: 17px;"><b>
			Make your floor operations digital and experience a whole new culture.</b>
		</p>
		<div style="text-align: center; font-size: 18px; background:rgba(255,255,255,0.2); margin: 7% 0%; padding: 3% 0%; font-family: 'Myriad Pro';">
			<span class="sqr">
				3
			</span>
			<span style="padding-left: 1%;">
				We are offering three months free services, for a better understanding.
			</span>
		</div>
		<h4 style="text-align: center; font-weight: bolder; padding-top: 5%;">
			Add your details and we’ll get back.
		</h4>
		<i class="fa fa-plus" aria-hidden="true" style="font-size: 20px; text-align: center; color: #fff; margin-left: 50%;" id="expand"></i>
	</div>          
</div>
<div id="form">
             <!-- {{ Form::open(array('route' => 'restaurantContact','id'=>'restaurant_details','onsubmit' => 'return validation();')) }} 

                <div>
                    <i id="cross" class="fa fa-times" aria-hidden="true" style="color: #fff; background-color: #000; padding: 1%; margin: auto; border-radius: 25px; font-size: 15px; margin-left: 50%;"></i>
                </div>
                <div class="input_box">
                    <input type="text" name="restaurants_name" placeholder="Restaurant Name" id="email" class="form-control">
                </div>
                <div class="input_box">
                    <input type="text" name="restaurants_address" placeholder="Restaurant Address" id="pwd" class="form-control">
                </div>
                <div class="input_box">
                    <input type="text" name="contact_name" placeholder="Contact Name"  id="te" class="form-control">
                </div>
                <div class="input_box">
                    <input type="text" name="contact_num" placeholder="Contact Number" id="tex" class="form-control">
                </div> -->
                <!-- <div class="input_box">
                    <input type="text" class="form-control"  name="message" id="text" placeholder="Message" style="background-color: #fff;"></textarea>
                </div>  --> 
                <!-- <div class="input_box" style="padding-left: 8%;">
                    <input type="submit" name="submit" style="background-color: #000; color: #fff; font-weight: bolder; padding: 8% 27%;  margin: auto;  font-size: 17px; border-radius: 5px; text-transform: uppercase;">
                </div>  
                {{ Form::close() }} -->
               
                     <?php echo form_open('',array('id'=>'restaurant_details')); ?>

               <!--  <div class="form-group">

                    <input type="email" class="form-control center-block animate fadeInDown" id="email" style="width:70%;border:none;border-bottom:2px solid black;box-shadow:0px 0px 0px 0px;border-radius:0px;font-size:16px;background-color:#e6e7e7;text-align:center;margin-top: 34px;" placeholder="Restaurant Name">

                </div>
                <div class="form-group">

                    <input type="text" class="form-control center-block animate fadeInDown" id="pwd" style="width:70%;border:none;border-bottom:2px solid black;box-shadow:0px 0px 0px 0px;border-radius:0px;font-size:16px;background-color:#e6e7e7;text-align:center;margin-top: 34px;" placeholder="Restaurant Address">

                </div>
                <div class="form-group">

                    <input type="text" class="form-control center-block animate fadeInDown" id="te" style="width:70%;border:none;border-bottom:2px solid black;box-shadow:0px 0px 0px 0px;border-radius:0px;font-size:16px;background-color:#e6e7e7;text-align:center;margin-top: 34px;" placeholder="Contact Name">
                </div>
                <div class="form-group">

                    <input type="text" class="form-control center-block animate fadeInDown" id="tex" style="width:70%;border:none;border-bottom:2px solid black;box-shadow:0px 0px 0px 0px;border-radius:0px;font-size:16px;background-color:#e6e7e7;text-align:center;margin-top: 34px;" placeholder="Contact Number"> 
                </div>
                <div class="form-group">

                    <input type="text" class="form-control center-block animate fadeInDown" id="text" style="width:70%;height:90px;border:none;box-shadow:0px 0px 0px 0px;border-radius:8px;font-size:16px;text-align:center;margin-top:34px;" placeholder="Your Message">
                </div>

                <button type="submit" class="btn btn-default center-block animate fadeInDown" style="width:auto;margin-top:34px;background-color:#161616;background-image:none;padding:20px;color:white;border-radius:8px;">SUBMIT</button> -->
                <div>
                    <i id="cross" class="fa fa-times" aria-hidden="true" style="color: #fff; background-color: #000; padding: 1%; margin: auto; border-radius: 25px; font-size: 15px; margin-left: 50%;"></i>
                </div>
                <div class="input_box">
                    <input type="text" name="restaurants_name" placeholder="Restaurant Name" id="email" class="form-control" style="width: 100%;">
                </div>
                <div class="input_box">
                    <input type="text" name="restaurants_address" placeholder="Restaurant Address" id="pwd" class="form-control" style="width: 100%;">
                </div>
                <div class="input_box">
                    <input type="text" name="contact_name" placeholder="Contact Name"  id="te" class="form-control" style="width: 100%;">
                </div>
                <div class="input_box">
                    <input type="text" name="contact_num" placeholder="Contact Number" id="tex" class="form-control" style="width: 100%;">
                </div>
                <div class="input_box">
                    <input type="text" class="form-control"  name="message" id="text" placeholder="Message" style="width: 100%;">
                </div>  
                <div class="input_box submit " style="">
                    <input type="submit" name="submit" style="background-color: #000; color: #fff; font-weight: bolder; padding: 8% 27%;  margin: auto;  font-size: 17px; border-radius: 5px; text-transform: uppercase;">
                </div>  

                <?php echo form_close(); ?> 
                
            </div>
            <div class="insta">
            	<img src="images/insta.png" class="img-responsive" style="margin: auto; width: 40px;">
            	<div class="container" style="padding-top: 3%; padding-bottom: 3%; padding-left: 35%;">
            		<ul  class="insta_ul" style="list-style: none; margin: auto;">

            			<li >
            				<img src="images/logo.png" class="img-responsive" style="width: 50px; border-radius: 25px; border:1px solid #dcd7d7; margin: auto;">
            			</li>
            			<li>
            				<h3 style="margin-top: 10px;">
            					afewtaps
            				</h3>
            			</li>
            			<li>
            				<a href="https://www.instagram.com/afewtaps/"><button style="color: #1cc1ea; padding: 5% 15%; background-color: transparent; border-radius: 15px; box-shadow: none; width: 125px; border:1px solid #1cc1ea; margin-left: 5%;">
            					<img src="images/plus.png" style="width: 10px; display: inline;" class="img-responsive">&nbsp; &nbsp;<span style="font-size: 14px; padding-top: 1%;">Follow</span>
            				</button>
            			</li>

            		</ul>
            	</div>
            	<div class="container">
            		<?php
                    // use this instagram access token generator http://instagram.pixelunion.net/
            		$access_token="2294090364.1677ed0.77254c412f0343b1a7b9b763358720be";
            		$photo_count=6;

            		$json_link="https://api.instagram.com/v1/users/self/media/recent/?";
            		$json_link.="access_token={$access_token}&count={$photo_count}";
            		$json = file_get_contents($json_link);
            		$obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);

            		foreach ($obj['data'] as $post) {

            			$pic_text=$post['caption']['text'];
            			$pic_link=$post['link'];
            			$pic_like_count=$post['likes']['count'];
            			$pic_comment_count=$post['comments']['count'];
            			$pic_src=str_replace("http://", "https://", $post['images']['standard_resolution']['url']);
            			$pic_created_time=date("F j, Y", $post['caption']['created_time']);
            			$pic_created_time=date("F j, Y", strtotime($pic_created_time . " +1 days"));

            			echo "<div class='col-md-4 col-sm-6 col-xs-12 item_box'>";        
            			echo "<a href='{$pic_link}' target='_blank'>";
            			echo "<img class='img-responsive photo-thumb' src='{$pic_src}' alt='{$pic_text}'>";
            			echo "</a>";
            			echo "<p>";
            			echo "<p>";
            			echo "<div style='color:#888;'>";
            			echo "<a href='{$pic_link}' target='_blank'>{$pic_created_time}</a>";
            			echo "</div>";
            			echo "</p>";
            			echo "<p>{$pic_text}</p>";
            			echo "</p>";
            			echo "</div>";
            		}
            		?>
            	</div> 

            </div>
            <div class="homepage_footer">
            		<div class="layer">
            			<img src="images/fb.png" class="img-responsive" style="margin: auto; height: 70px;">            
            			<h1 style="text-align: center; color: #fff; padding-top: 17%; margin-bottom: 0; ">
            				A Delhi based startup @work.
            			</h1>
            			<p style="text-align: center; color: #dcdcdc; ">
            				Copyright &copy; 2017 Think Different Technologies (P) Ltd
            			</p>
            			<div style="color: #fff; padding-top:17%; font-family: 'Myriad Pro';">
            				<div class="col-lg-6 col-sm-12 email_footer">
            					<img src="images/email.png" class="img-responsive" style="width: 50px; display: inline; padding-right: 1%; " ><span style="color:#fff;">info@afewtaps.com</span>
            				</div>
            				<div class="col-lg-6 col-sm-12 list">
            					<ul id="footer_list">
            						<li><a href="<?php echo site_url(); ?>/welcome/career" style="text-decoration: none; color: #fff;">Career</a></li>
                                      <li><a href="<?php echo site_url(); ?>/welcome/faq" style="text-decoration: none; color: #fff;">FAQ</li>
                                      <li><a href="<?php echo site_url(); ?>/welcome/blog" style="text-decoration: none; color: #fff;">Blog</a></li>
                                      <li><a href="<?php echo site_url(); ?>/welcome/feedback" style="text-decoration: none; color: #fff;">Feedback</a></li>
                                      <li><a href="<?php echo site_url(); ?>/welcome/privacypolicy" style="text-decoration: none; color: #fff;">Privacy</a></li>
                                   <li><a href="<?php echo site_url(); ?>/welcome/terms" style="text-decoration: none; color: #fff;">Terms</a></li>
            					</ul>
            				</div>
            			</div>
            		</div>
            	</div>



            <script>
            	function validation() {

            		var name      = $.trim($("#name").val());
            		var email     = $.trim($("#email").val());
            		var mobile    = $.trim($("#mobile").val());
            		var address   = $.trim($("#address").val());
            		var captcha   = $.trim($("#captcha").val());

            		if (!name)
            		{
            			displayMessage("Name field is required.");
            			return false;
            		}

            		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            		if ((! name) || ( ! regex.test(email)))
            		{
            			displayMessage("Email field must contain a valid email address.");
            			return false;
            		}

            		var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
            		if ( (! filter.test(mobile))  || (mobile.length != 10)) 
            		{
            			displayMessage("Mobile field must contain a valid number.");
            			return false;
            		}

            		if (!address)
            		{
            			displayMessage("Address field is required.");
            			return false;
            		}	

            		if (!captcha)
            		{
            			displayMessage("Captcha field is required.");
            			return false;
            		}	

            		$("#msginfo").removeClass('error').addClass('success').html('just a moment...');

            		$.ajax({
            			type : 'POST',
            			url : '<?php echo base_url(); ?>index.php/signup',
            			data : $('#signup').serialize(),
            			dataType: "json",
            			success: function(resp) {
            				if (resp.msg == 'success')
            				{
            					$("#name").val('');
            					$("#email").val(''); 
            					$("#mobile").val(''); 
            					$("#address").val(''); 
            					$("#captcha").val(''); 
												  //$("#msginfo").removeClass('error').addClass('success').html('Waiting for review');
												  changeCaptcha();
												  alert("Thank you for your interest. Allow us some time to get back to you.");
												}

												if (resp.msg == 'validation')
												{
													$("#msginfo").removeClass('success').addClass('error').html('This Email ID is already exists.');
												}

												if (resp.msg == 'captcha_error')
												{
													$("#msginfo").removeClass('success').addClass('error').html('You must submit the word that appears in the image.');
												}  

												if (resp.msg == 'failure')
												{
													$("#msginfo").removeClass('success').addClass('error').html('All fields contain valid data.!');
												}  

												setInterval(function(){ $("#msginfo").html('').removeClass('success error'); }, 4000);

											},

											error: function (xhr, ajaxOptions, thrownError) 
											{
												$("#msginfo").removeClass('success').addClass('error').html('Internal Server Error .! Try again after sometime.');
						//setInterval(function(){ $("#msginfo").html('').removeClass('success error'); }, 4000);
					}
				});
            		return false;
            	}

            	function displayMessage(msg)
            	{
            		$("#msginfo").removeClass('success').addClass('error').html(msg);
		 // setInterval(function(){ $("#msginfo").html('').removeClass('success error'); }, 6000);
		}

		function changeCaptcha()
		{
			$.ajax({
				type : 'POST',
				url : '<?php echo base_url(); ?>index.php/captcha',
				data : {},
				dataType: "json",
				success: function(resp) {
					$("#captchacontainer").html('<img id="" src="<?php echo base_url(); ?>captcha/' + resp.file + '" style="width: 150; height: 30; border: 0;" alt="">');
				}
			});
		}
	</script>




