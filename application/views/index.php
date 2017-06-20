<?php

$this->load->view('include/header.php');

?>


<body data-spy="scroll" data-target=".navbar">
<header class="row">
 <!-- Navigation Bar -->
      <nav id="main-nav" class="navbar navbar-default navbar-fixed-top navbar-inverse darken center-block" role="navigation" style="border-radius:8px;margin-top:6px;z-index:20000;">
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
      <li class="thenavlist"><a  href="#">Products</a></li>
      <li class="thenavlist"><a  href="#howitworks" >How it works?</a></li>
      <li class="thenavlist"><a  href="#atthemovies!">at the movies!</a></li>
      <li class="thenavlist"><a  href="#business">Business</a></li>
      <li class="thenavlist"><a  href="#"><img src="images/instagram.png" alt="instagram" /></a></li>
      <li class="thenavlist"><a  href="#getintouch">Get in Touch</a></li>
      </ul>
    </div>
  </div>
      </nav>
</header>

<!-- loader -->   
<div id="loadingthescreen">
<div id="itsloading">

<img src="images/spin.gif" class="center-block" alt="loading...">


</div>
</div>
<!-- end of loader -->


  
<div class="thefirstdiv">   
<div style="padding-left:20px;padding-right:20px;padding-top:20px;"> 

    <div class="container-fluid">

        <!--Row with three equal columns-->

        <div class="row">

            <div class="col-xs-4 col-md-4 "><span class="pull-left openingnavbar" onclick="openNav();"><img src="images/slideopen.png" alt="open sidebar"> </span></div>

			<!-- this is the sidebar menu -->
			
			<div id="mysidenav" class="sidenav">
<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
<div style="padding-left:10px;padding-right:10px;color:black;"> 
<!-- header of sidebar -->
<div class="row" style="padding-top:30px;"> 
	<div class="col-xs-6 col-md-6">
		<img  src="images/logoside.jpg" class="pull-left img-responsive" alt="logo">
	</div>
	<div class="col-xs-6 col-md-6">
		<img src="images/instagram.png" class="img-responsive pull-right" style="padding-top:20px;" alt="instagram">

	</div>
	

</div> 
<div style="height:2px;border:1px solid black;"></div>

<!-- end of the header of sidebar -->
<!-- middle content of the sidebar -->
<p class="text-center" style="font-size:14px;padding-top:70px;font-weight:bold;font-family:savoye let;font-style:italic;">"A Digitally empowered society and a knowledge economy"</p>

<img src="images/E1-F.png" class="center-block img-responsive" style="padding-top:50px;width:40px;padding-bottom:4px;" alt="image" >

<p class="text-center" style="font-size:15px;font-weight:bold;font-family:savoye let;font-style:italic;letter-spacing:.5px;">#digitalindiavision</p>

<div class="row" style="padding-top:60px;">

<div class="col-xs-6 col-md-6">

<a style="text-decoration:none;" href="https://itunes.apple.com/it/app/afewtaps/id1183721598?mt=8" target="_blank"><img src="images/apple.png"  class="img-responsive center-block pull-right" alt="apple"></a>
</div>
<div class="col-xs-6 col-md-6"> 
<a style="text-decoration:none;" href="https://play.google.com/store/apps/details?id=com.afewtaps.afewtaps&hl=en" target="_blank"><img src="images/android.png" class="img-responsive  center-block pull-left" alt="android"></a>
</div>
</div>



<p class="text-center" style="font-size:14px;padding-top:20px;">Download whenever you feel like,</p>
<p class="text-center" style="font-size:14px;">Its available on iOS for free,and coming soon on Android...</p>


<!-- end of the middle content of sidebar -->
</div>
<div class="center-block">
	<div style="text-align:center;color:#008080;word-spacing:14px;padding-top:50px;">
	 <ul>
	  <li class="thisiwllberight"><a href="">BLOG </a></li>
	  <li class="thisiwllberight"><a href="">FEEDBACK</a></li>
	  <li class="thisiwllberight"><a href="<?php echo site_url(); ?>/welcome/career">CAREER</a></li>
	  <li class="thisiwllberight"><a href="<?php echo site_url(); ?>/welcome/faq">FAQ</a></li>
	  <li class="thisiwllberight"><a href="<?php echo site_url(); ?>/welcome/privacypolicy">PRIVACY</a></li>
	  <li class="thisiwllberight"><a href="<?php echo site_url(); ?>/welcome/terms">TERMS</a></li>
	</ul>
	</div>
</div>
</div>
			
			
			
			
			<!-- this is the sidebar menu ending -->
			
			
			
            <div class=" col-xs-4 col-md-4"><p class="text-center" style=""><img style="width:60px;" src="images/newlogo.png" alt="logo"></p>
			<p class="text-center" style="font-family:Savoy LET;line-height:2em;"><span style="font-family:savoye let;font-size:40px;font-style:italic;text-shadow:1px 1px #808080;">afewtaps</span><br><span style="font-size:22px;font-family:savoye let;font-style:italic;"> Convenience Matters </span></p>
			
			</div>

            <div class=" col-xs-4 col-md-4">
			<span class="pull-right" data-toggle="modal" data-target="#myModal" style="cursor:pointer;">
			<img style="padding-left:4px;" src="images/loginicon.png"  alt="login"><br>
			<span  style="font-size:14px;cursor:pointer;">Login</span>
			</span>
			</div>
			
	<!-- this is the login popup -->
	
	
	
	<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color:#161616;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
          </div>
        </div>
        <div class="modal-footer" style="border-top:0px;background-color:#f6f6f6;">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
	
	
	
	
	
	<!-- end of login  popup -->		
			
			
			
			

        </div>

   </div>

<div>
<p class="text-center animate fadeInUp" style="font-size:50px;letter-spacing: 0.024em;padding-top:20px;"><span class="theheadingsreponsive">Introducing the next generation <br>in-restaurant technology</span></p>
<p class="text-center animate fadeInUp " style="font-size:20px;padding-top:10px;padding-bottom:10px;"><span style="font-weight:bold;">Take</span> Orders. <span style="font-weight:bold;">Place</span> Orders.</p>
<p class="text-center animate fadeInUp" style="font-size:16px;padding-top:10px;">App for restaurants <span style="font-weight:bold;">to take customer orders</span><br>
and for customers <span style="font-weight:bold;">to place orders.</span></p>
<p class="text-center animate fadeInDown" style="font-size:16px;font-weight:bold;text-shadow:1px 0px black;">#speedofservice <br> #notforhomedelivery</p>
<p class="text-center animate fadeInDown" style="font-size:16px;font-weight:bold;text-shadow:1px 0px black;"></p>
</div>
		<div class="row" style="margin-top:60px;">

            <div class=" col-sm-4 col-md-4">
			<img style="width:28%" src="images/landingpagedigital.png" alt="digitalindia">
			</div>

            <div class="col-sm-4 col-md-4"><p class="text-center" style="font-size:16px;">Taking Restaurant Technology to the next level<br>

<div class="center-block animated fadeInDown" id="blink_me">
<img src="images/icon-arrow-down-b-128.png" style="width:30px;" class="center-block img-responsive" alt="icon-arrow-down">
</div>

</p>
</div>

            <div class="col-sm-4 col-md-4">
			
			<ul class="pull-right"  style="margin-bottom:20px;list-style-type:none;">
			<a style="text-decoration:none;" href="https://itunes.apple.com/it/app/afewtaps/id1183721598?mt=8" target="_blank"><li><span  class="androidappfirst">
				 <img style="vertical-align:middle" src="images/apple.png" alt="apple">
                 <span style="color:black;">App Store</span>
				</span>
				
				</li></a>
				
			
			
			<a style="text-decoration:none;" href="https://play.google.com/store/apps/details?id=com.afewtaps.afewtaps&hl=en" target="_blank"><li style="margin-top:24px;"><span class="androidappfirst" >
				 <img style="vertical-align:middle" src="images/android.png" alt="androind">
                 <span style="color:black">Play Store</span>
				</span>
				
				</li></a>
			
			
			
			</ul>

			
			
			
			</div>

        </div>	
</div>	
</div>	
	
<!-- First division ends here -->

<!-- Second Division -->
<div id="theseconddiv">
	<div style="padding-left:20px;padding-right:20px;padding-top:20px;"> 
	
	<p class="text-center animate fadeInDown" style="font-size:50px;padding-top:20px;"><span class="theotherheadingsreponsive">afewtaps - Customer App</span></p>	
	<p class="text-center animate fadeInDown" style="font-size:16px;padding-top:10px;"><span style="font-weight:bold;">Fast. Simple Interface.<br>
My Personal Menu. Repeat Orders.</span></p>	
	<p class="text-center animate fadeInDown " style="font-size:14px;padding-top:20px;">Place orders anytime without having to wait for staff attention.<br>Have your own personal menu at each restaurant and repeat orders, for fast ordering,<br> as we live up to the name - <span style="font-weight:bold;">afewtaps</span>.</p>	
<!-- the learn more button -->
	<p class="text-center" id="showthirdfourthfifth" style="font-size:14px;padding-top:20px;padding-bottom:20px;color:#03a6ff;width:10%;margin:0px auto;"><a href="<?php echo site_url(); ?>/welcome/userapp">Learn More <span style="color:black;font-weight:bold;">></span></a>

</p>	
<!-- end of the learn more button -->
     </div>

<div style="padding-left:20px;padding-right:20px;padding-top:20px;">

<img src="images/iphonee.png" alt="iphone" class="center-block img-responsive animate fadeInUp" style="width:350px;">			
			
			
			
	
	

    </div>
	
</div>


<!-- sixth slide -->

<div class="thesixthslide"> 
<div style="padding-left:20px;padding-right:20px;padding-top:50px;padding-bottom:0px;"> 
	
	<p class="text-center animate fadeInRight" style="font-size:50px;padding-top:20px;"><span class="theotherheadingsreponsive">afewtaps - Service App</span></p>	
    <p class="text-center animate fadeInRight" style="font-size:16px;font-weight:bold;padding-top:20px;">Take Orders. Receive orders.<br>
POS Entry. Improve table-turns.</p>
  <p class="text-center animate fadeInLeft" style="font-size:14px;">A restaurant <b>service guy</b> can <b>take</b> customer orders right from a smartphone<br> and enter it to the restaurant POS on the go. This ensures no time is lost during service.<br>
They shall <strong>receive</strong> all incoming customer orders on a separate tablet,acting as a secondary POS,<br>
 and the same is directly entered into the primary restaurant POS. This ensures consistency.</p>
<p class="text-center animate fadeInUp" style="font-size:14px;padding-top:10px;">Its time to eliminate Service Errors like customer wait time for placing orders,<br>while improving on table-turns and serving more customers.</p>
<!-- the learn more button -->
<p class="text-center" id="showseveneightnineten" style="font-size:14px;padding-top:20px;color:#03a6ff;width:20%;margin:0px auto;padding-bottom:0px;cursor:pointer;"><a href="<?php echo site_url(); ?>/welcome/servapp">Learn About Service App <span style="color:black;font-weight:bold;">></span></a>

</p>	

<!-- <img class="center-block animate fadeInLeft img-responsive" src="images/5.png" class="img-responsive center-block">  -->

<!-- slides 8 9 10 11 -->
<!-- carousel -->
<div class="thisisthemobcar">
<div style="padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px;">
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="2000" >
  <!-- Indicators -->
 

  <!-- Wrapper for slides -->
  
 
		
   <div class="carousel-inner" role="listbox">
  	  
    <div class="item active">
	<div class="container">

	
      <img src="images/receivecust.png" class="img-responsive" alt="...">
	  
      <div class="carousel-caption">
        
      </div>
    </div>
	</div>
    <div class="item">
     <div class="container">
	   
	
       <img src="images/receivecust.png" class=" img-responsive" alt="...">
	  
      <div class="carousel-caption">
        
      </div>
    </div>
	  
      <div class="carousel-caption">
       
      </div>
    </div>
	<div class="item">
      <div class="container">
	  
	
     <img src="images/3.png" class="img-responsive" alt="...">
	  
      <div class="carousel-caption">
         
      </div>
    </div>
	  
    
    </div>
	
  
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>  
</div>
<!-- end of carousel -->
<!-- end of slides 8 9 10 11 -->

<!-- testing the main slider -->
<!-- <div class="row">
<div id="wrapper_bu">

<div id="bu1">  <img src="images/slidehome2.png" class="img-responsive center-block " alt="..."></div>
<div id="bu2">  <img src="images/slidehome1.png" class="img-responsive center-block" alt="..."></div>
<div id="bu3">  <img src="images/slidehome3.png" class="img-responsive center-block" alt="..."></div>
<div id="bu4">  <img src="images/slidehome4.png" class="img-responsive center-block" alt="..."></div>
<div id="bu5"> <img src="images/slidehome5.png" class="img-responsive center-block" alt="..."></div>
</div> 
</div> -->




<!-- end of testing the main slider -->

<!-- this is the second carousel testing -->

<div class="thisisthelapcar">
<div class="row">
<div class="container">
<div class="containerss" id="container" style="padding-top:30px;padding-bottom:30px;">
  <ul>
  

    <li style="z-index:0;">
     <img src="images/receivecust.png" class="img-responsive" alt="...">
    </li>
   
    
    

    <li style="z-index:0;">
     <img src="images/receivingcust2.png" class=" img-responsive" alt="...">
    </li>
    
 
    
   
    <li style="z-index:0;">
     <img src="images/3.png" class="img-responsive" alt="...">
    </li>
    </li>
   
    
     <img src="images/left.png" class="left" style="left:-100px;position:absolute;" alt="left">
    <img src="images/right.png" class="right" style="right:-100px;position:absolute;" alt="right">
    </ul>
</div>
</div>
</div>
</div>
<!-- end of the second carousel testing -->






<!-- end of the learn more button -->
</div>
</div> 






<!-- SLIDES 13 , 14 -->

<div class="slidethirteen" style="border-bottom:1px solid #d1d2bf;box-shadow: 0 5px 5px -5px #333;">
 <div style="background-color:#f2f2f2">
<p class="text-center animate fadeInUp" style="font-size:50px;padding-top:50px;"><span class="theotherheadingsreponsive">An android based app, to speed up your service.</span></p>	
<img src="images/Untitled-29.png" class="center-block img-responsive animate fadeInDown" alt="untitled" style="padding-top:20px;padding-bottom:20px;">
<p class="text-center animate fadeInDown" style="font-size:22px;"><span style="font-weight:bold;">#service</span>app</p>	
<p class="text-center animate fadeInDown" style="font-size:14px;">A <span style="font-weight:bold;">Restaurant Technology</span> to handle floor operations on an <span style="font-weight:bold;">individual</span> staff level, and in the most <span style="font-weight:bold;">efficient manner.</span></p>
<p class="text-center animate fadeInUp" style="font-size:14px;">The service app is a new introduction to Restaurant Technology.</p>
<p class="text-center animate fadeInUp" style="font-size:14px;padding-top:20px;padding-bottom:100px;">With this, we make <span style="font-weight:bold;">restaurant performance</span> fast and efficient,<br> while staying equipped for future technologies.</p>
</div>
<p class="text-center animate fadeInDown" style="font-size:14px;padding-top:30px;padding-bottom:30px;">Its available on Google Play Store
</p>
<p class="text-center">

<a href="https://play.google.com/store/apps/details?id=com.afewtaps.afewtaps&hl=en" target="_blank" style="text-decoration:none;"><span class="androidappsec" >
				 <img style="vertical-align:middle" src="images/android.png" alt="android">
                 <span style="color:black">Play Store</span>
				</span></a>

</p>
<p style="padding-bottom:40px;"></p>




</div>

<!-- 14 slide -->
<div class="slidefourteen">

<p class="text-center " style="font-size:50px;padding-top:50px;padding-bottom:40px;"><span class="theotherheadingsreponsive">Benefits of serving with a service app</span></p>	
<!-- benefits list test -->

<!-- testing something -->


<div class="container" style="border-bottom:1px solid #d1d2bf;">
<div class="row seven-cols" >
<div class="col-xs-2 col-md-2 thehomeicos">
<img src="images/ii1.png" class="thefirstpicture  changicosiz center-block img-responsive" alt="image">

</div>
<div class="col-xs-2 col-md-2 thehomeicos  ">

<img src="images/ii2.png" class="thesecondpicture changicosiz  center-block img-responsive" alt="image">
</div>
<div class="col-xs-2 col-md-2 thehomeicos    ">
<img src="images/ii3.png" class="thethirdpicture changicosiz  center-block img-responsive" alt="image">

</div>
<div class="col-xs-2 col-md-2 thehomeicos     ">
<img src="images/ii4.png" class="thefourthpicture  changicosiz  center-block img-responsive" alt="image">

</div>
<div class="col-xs-2 col-md-2 thehomeicos    ">
<img src="images/ii5.png" class="thefifthpicture  changicosiz  center-block img-responsive" alt="image">

</div>
<div class="col-xs-2 col-md-2 thehomeicos    ">

<img src="images/ii6.png" class="thesixthpicture  changicosiz  center-block img-responsive" alt="image">
</div>
<div class="col-xs-2 col-md-2 thehomeicos    ">

<img src="images/ii7.png" class="theseventhpicture changicosiz  center-block img-responsive" alt="image">
</div>


</div>
</div> 


<!-- end of testing something -->



<div class="thefirstcontent" style="text-align:center;padding-top:30px;transition:all 1s ease;">
<div class="container">
<p style="font-size:18px;font-weight:bold;" class="animate fadeInDown">Increase in Sales</p>
<p style="font-size:14px;" class="animate fadeInDown">With smartphone ordering, restaurants may reduce their staff strength <br>and still serve better, and so with cost reduction, comes<br> increased profit margin.</p>
</div>
</div>

<div class="thesecondcontent" style="text-align:center;padding-top:30px;transition:all 1s ease;">
<div class="container">
<p style="font-size:18px;font-weight:bold;" class="animate fadeInDown">Sophisticated Brand Images</p>
<p style="font-size:14px;" class="animate fadeInDown">Our system removes human errors and brings speed and smoothness to restaurant operations.</p>
</div>
</div>

<div class="thethirdcontent" style="text-align:center;padding-top:30px;transition:all 1s ease;">
<div class="container">
<p style="font-size:18px;font-weight:bold;" class="animate fadeInDown">Improving Table-turns</p>
<p style="font-size:14px;" class="animate fadeInDown">With smartphone order taking, the restaurant staff saves time during service by not having to go to & <br>fro from the customer to their POS software, and improves on table-turns, thus serving more <br>customers in the long run, thereby increasing sales.</p>
</div>
</div>

<div class="thefourthcontent" style="text-align:center;padding-top:30px;transition:all 1s ease;">
<div class="container">
<p style="font-size:18px;font-weight:bold;" class="animate fadeInDown">Customer Data</p>
<p style="font-size:14px;" class="animate fadeInDown">Having customer data like what they prefer and at what time, how much they spend, restaurants they <br>visit etc. can help you understand people and bring back customers, for repeat sales, while attracting<br> new ones at the same time. </p>
</div>
</div>

<div class="thefifthcontent" style="text-align:center;padding-top:30px;transition:all 1s ease;">
<div class="container">
<p style="font-size:18px;font-weight:bold;" class="animate fadeInDown">Floor Operations</p>
<p style="font-size:14px;" class="animate fadeInDown">The system increases Quality and Speed of service. <br>
Decrease your order placement to order delivery to bill payment time and make room for more customers.
</p>
</div>
</div>

<div class="thesixthcontent" style="text-align:center;padding-top:30px;transition:all 1s ease;">
<div class="container">
<p style="font-size:18px;font-weight:bold;" class="animate fadeInDown">Good Reviews on platforms like Zomato</p>
<p style="font-size:14px;" class="animate fadeInDown">With good service, comes great reviews, since there is no room left for service errors,<br>
and with great reviews, comes better ratings, and with better ratings, comes cheaper services.
</p>
</div>
</div>

<div class="theseventhcontent" style="text-align:center;padding-top:30px;transition:all 1s ease;">
<div class="container">
<p style="font-size:18px;font-weight:bold;" class="animate fadeInDown">Timely Service</p>
<p style="font-size:14px;" class="animate fadeInDown">The staff doesn’t have to go back to a fixed POS and lose time ordering from there.<br> 
They’re more available to customers, which results in better service.
</p>
</div>
</div>




<!-- end of benefits list test -->












<!-- <p class="text-center animate fadeInDown" style="font-size:22px;padding-top:120px;padding-bottom:20px;font-weight:bold">Service Improvement</p>	
<p class="text-center animate fadeInDown" style="font-size:14px;padding-bottom:40px;">Eliminating manual <span style="font-weight:bold;">order taking errors </span>like<br>
customer waiting, wrong order,<br>
taking too long for the bill to arrive or settle,<br>
forgetting customer orders and such</p> -->

</div>


<!-- 14 slide -->


<!-- END OF SLIDES  13,14 -->
	
<!-- 15 slide -->	
	
<div class="fifteenslide"  >
<p class="text-center " style="font-size:50px;padding-top:80px;"><span class="theotherheadingsreponsive animate fadeInDown">afewtaps - Web Dashboard</span></p>	
<p class="text-center animate fadeInDown" style="font-size:22px;font-weight:bold;">View. Control. Edit. Supervise.</p>

<p class="text-center animate fadeInDown" style="font-size:14px;padding-bottom:50px;">A dashboard to handle and control on-going operations.</p>
<!-- the learn more button -->
	<p class="text-center animate fadeInDown" id="learnmore_webdash" style="font-size:14px;color:#03a6ff;width:20%;margin:0px auto;padding-bottom:60px;cursor:pointer;"><a href="<?php echo site_url(); ?>/welcome/management">Learn More <span style="color:black;font-weight:bold;">></span></a><br>
</p>	
<!-- end of the learn more button -->
<img src="images/MacBook_Pro_Retina.png" class="img-responsive center-block animate fadeInDown" style="padding-bottom:90px;" alt="macbook-pro-retina">





</div>

<!-- end of 15 slide  -->
	



<!-- slide 18 -->

<div class="slideeighteen" style="box-shadow: 0 -5px 5px -5px snow;" id="howitworks"> 
<div style="padding-left:20px;padding-right:20px;padding-top:10px;padding-bottom:60px;">
 
<p class="text-center " style="font-size:50px;padding-top:50px;"><span class="theotherheadingsreponsive animate fadeInDown">How it works?</span></p>	
<div class="row">
<div class=" col-xs-2 col-md-2">

</div>
<div class="col-xs-2 col-md-2">

</div>
<div class="col-xs-2 col-md-2">
<img src="images/2213.png" style="width:120px;" class="center-block img-responsive pull-right animate fadeInDown" alt="image">
</div>
<div class="col-xs-2 col-md-2">
<img src="images/12323.png" style="width:120px;" class="center-block img-responsive  pull-left animate fadeInDown" alt="image">
</div>
<div class=" col-xs-2 col-md-2">

</div>
<div class=" col-xs-2 col-md-2">

</div>


</div>



<p class="text-center animate fadeInDown" style="font-size:14px;padding-bottom:40px;">We place beautifully designed cards on the tables in order to mark areas of the restaurant.<br>
This way, the customer knows their Table No.</p>

<p class="text-center animate fadeInDown" style="font-size:22px;font-weight:bold;">The Future</p>
<img src="images/expand.png" class="img-responsive center-block animate fadeInUp" style="width:42px;" alt="image"> 
<img src="images/tablewithnum.png" class="img-responsive center-block animate fadeInDown" alt="image">  
</div>
</div>

<!-- end of slide 18 -->

<!-- slide 19 -->
<div class="slidenineteen">
<div style="padding-left:20px;padding-right:20px;padding-top:10px;">
 
<p class="text-center animate fadeInDown" style="font-size:22px;letter-spacing: 0.10em;padding-bottom:40px;padding-top:60px; color: #11effc;">“What we propose to restaurants, is having a mix of both worlds (Manual &<br>
Smartphone ordering) for the customer.”
</p>

<p class="text-right animate fadeInLeft" style="font-size:14px;letter-spacing: 0.10em;padding-bottom:60px;color:#f6f6f6;">
#usecase<br>
Manual Ordering during light footfall<br>
Manual + Smartphone Ordering during heavy footfall


</p>



</div>
</div>

<!-- end of slide 19 -->

<!-- slide 20 -->
<div class="slidetwenty" id="atthemovies!">
<div style="padding-left:20px;padding-right:20px;padding-top:10px;">
 
 <img src="images/newlogo.png" class="img-responsive center-block" style="width:80px;border:2px solid #161616;border-radius:10px;" alt="logo">
<p class="text-center animate fadeInDown thelogotextcl" style="font-size:18px;padding-top:4px;">Other industries where <span style="font-weight:bold;font-size:18px;">afewtaps</span> would be a natural fit:
</p>

<p class="text-center animate fadeInDown" style="font-size:50px;">
at the movies!
</p>

<img src="images/cartnnn.jpg" class="img-responsive center-block animate fadeInDown" style="padding-bottom:20px;width:380px" alt="cartn">
<p class="text-center animate fadeInDown" style="font-size:14px;padding-top:60px;">
Place orders at the comforts of your seat, while watching movies.

</p>
<p class="text-center" style="font-size:20px;">
<img src="images/star.png" class="img-responsive center-block animate fadeInDown" style="width:32px;" alt="star">
</p>
<p class="text-center animate fadeInDown" style="font-size:14px;">
<span style="color:#00AAAA;font-weight:bold;"><a href="mailto:info@afewtaps.com">Email us</a></span> your interest and we’ll send you a formal proposal.
</p>

</div>
</div>

<!-- end of slide 20 -->

<!-- SLIDE 21 -->


<div class="slidetwentyone" id="business">
<div style="padding-left:20px;padding-right:20px;padding-top:60px;">
 
<img src="images/MacBook_Pro_Retina.png" class="img-responsive center-block animate fadeInDown" style="width:30%;" alt="macbook-pro-retina">
<p class="text-center animate fadeInDown" style="font-size:50px;">
afewtaps - <span style="font-weight:bold;">Business</span>
</p>

<p class="text-center animate fadeInDown" style="font-size:14px;padding-top:20px;padding-bottom:20px;">
Make your restaurant operations digital and experience a<br>
whole new culture.<br>
Make movie time the most convenient time.<br>


</p>

<p class="text-center animate fadeInDown" style="font-size:14px;padding-bottom:40px;">
We are offering a <span style="font-weight:bold;">3-month free </span>service, for a better understanding of our software.</p>

<!-- the iframe content -->

<!-- <div class="embed-responsive embed-responsive-16by9 center-block" style="width:50%;">
<iframe class="center-block animate fadeInDown embed-responsive-item" style="border-radius:8px;box-shadow: 0 10px 20px -5px rgba(115,115,115,0.75),
                10px 0 20px -5px rgba(115,115,115,0.75);" width="640" height="360" src="https://www.youtube.com/embed/uVRcbo9_OdA" frameborder="0" allowfullscreen></iframe>
     </div>  -->         
<!-- end of the iframe content -->

<!-- custom iframe -->
<img src="images/video.JPG" class="img-responsive center-block animate fadeInDown" alt="video" style="border-radius:8px;box-shadow: 0 10px 20px -5px rgba(115,115,115,0.75),
                10px 0 20px -5px rgba(115,115,115,0.75);">



<!-- end of custom iframe -->

</div>
<div style="background-color:#f6f6f6;margin-top:60px;">
<div style="padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px;">
<p class="text-center animate fadeInDown" style="font-size:14px;font-weight:bold;">Reach us out and we would be happy to discuss business.</p>
<p class="text-center animate fadeInDown" style="font-size:14px;color:#03a6ff;font-weight:bold;"><span><img alt="message" src="images/1480527722_message.png" style="padding-right:10px;"></span><a href="mailto:info@afewtaps.com">info@afewtaps.com</a></p>
<p class="text-center animate fadeInDown" style="font-size:14px;color:#03a6ff;font-weight:bold;padding-right:13px;"><span><img alt="iphone" src="images/1480527693_BT_iphone.png" style="padding-right:5px;"></span>+91 9899898972</p>
<p class="text-center animate fadeInDown" style="font-size:14px;">or,</p>
<p class="text-center animate fadeInDown" style="font-size:20px;">Add your details and we’ll get back.</p>
<img id="showform" src="images/learnmorebtn.png" class="center-block animate fadeInDown" alt="learnmore">

</div>
</div>
</div>







<!-- end of slide 21  -->


<!-- SLIDE 22 -->
<!--  slide cancelled <div class="slidetwentytwo">
<div style="padding-left:20px;padding-right:20px;padding-top:10px;">
<p class="text-center" style="font-size:50px;">
<span style="font-weight:bold;">2,200</span> per month<br>
+<br>
<span style="font-weight:bold;font-size:20px;">One - time cost of Android Devices</span>

</p>

<p class="text-center" style="font-size:20px;font-weight:bold;padding-top:20px;">
What you get ?</p>

<p class="text-center" style="font-size:20px;padding-bottom:40px;padding-top:20px;">Customer App<br>
Service App<br>
Web Dashboard<br>
Android Devices for staff<br>
POS Integration<br>
Location Identifiers<br>
A guarantee on Speed of Service</p>


<p class="text-center" style="font-size:20px;padding-bottom:20px;">* For the first 3 months, we ask for 50% of the cost of devices required by the restaurant.<br>
The entire amount is refundable in case you wish to opt out of our services, after the free period ends.</p>
</div>
</div> end of slide cancelled -->


<div>
<div style="padding-left:20px;padding-right:20px;padding-top:10px;padding-bottom:20px;">


</div>

</div>




<!-- end of slide 22 -->
<!-- slide 23, 24 -->

<div id="twentythree_twentyfour">
<div class="center-block" style="padding-left:20px;padding-right:20px;width:80%;background-color:#e6e7e7;padding-top:40px;padding-bottom:40px;border-radius:8px;">
<!-- the close button -->


<img class="theclosebuttonformopen center-block " alt="image" src="images/learnmorebtn.png"  style="transform:rotate(315deg);width:40px;">




<!-- end of the close button -->

<?php echo form_open(); ?>

  <div class="form-group">
    
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
  
  <button type="submit" class="btn btn-default center-block animate fadeInDown" style="width:auto;margin-top:34px;background-color:#161616;background-image:none;padding:20px;color:white;border-radius:8px;">SUBMIT</button>
  
  <?php echo form_close(); ?>



</div>



</div>










<!-- end of slide 23,24 -->
<!-- the instagram posts -->
<!--
<div class="instagrampost">
<div style="padding-left:20px;padding-right:20px;border:1px solid black;">




<script src="https://snapwidget.com/js/snapwidget.js"></script>
<iframe src="https://snapwidget.com/embed/291288" class="snapwidget-widget" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:100%; "></iframe> 






</div>
</div> -->



<!-- the instagram posts -->


<!-- slide 26 -->
<div style="padding-bottom:60px;" id="getintouch">

<img  alt="image" src="images/Untitled-26.png" class="img-responsive center-block animate fadeInDown" style="width:200px;">

<p class="text-center animate fadeInDown" style="font-size:50px;padding-bottom:40px;">
Get In Touch</p>

<img alt="image" src="images/Untitled-27.png" style="width:160px;" class="img-responsive center-block animate fadeInDown">

<p class="text-center animate fadeInDown" style="font-size:14px;padding-bottom:60px;">
Want to discuss our services or ask anything that pops up in your head,<br>
we’re genuinely interested.</p>

<div class="center-block animate fadeInDown" style="width:30%;border-top:2px solid black;border-bottom:2px solid black;padding-top:20px;padding-bottom:20px;margin-bottom:10px;">
<p class="text-center animate fadeInDown" style="font-size:14px;font-weight:bold;">
<span><img alt="image" src="images/1480527722_message.png" style="padding-right:10px;"></span>Write to us at <span style="font-weight:bold;color:#00AAAA;"><a href="mailto:info@afewtaps.com">info@afewtaps.com</a></span> <br> or <br> <span><img alt="image" src="images/1480527693_BT_iphone.png" style="padding-right:5px;"></span>Call us at  <span style="font-weight:bold;color:#00AAAA;">+91 9899898972</span>

</p>
</div>
</div>





<!-- end of slide 26 -->



<!-- back to top button -->


    <a href="#top"  onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
        <img alt="image" src="images/arrow-up.png" id="top-link-block" class="img-responsive hidden">
    </a>
<!-- /top-link-block -->




<!-- end of back to top button -->

<?php


$this->load->view('include/footer.php');


?>



