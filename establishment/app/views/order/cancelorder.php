<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo config_item('admin_page_title'); ?></title>
<link rel="shortcut icon" href="<?php echo base_url();?>favicon.ico" type="image/x-icon">
<link href="<?php echo config_item('base_url'); ?>assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/animate.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/style.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/custom.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/awesome-bootstrap-checkbox.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/jquery.mCustomScrollbar.css" rel="stylesheet">
<style>


.lnehght30{line-height:30px}
.lnehght40{line-height:40px}
.lnehght24{line-height:24px}
.wdth100{width:100%}
.wdth80{width:80%}
.wdth20{width:20%}
.fdItem{margin-left:20px;margin-bottom:10px}
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

.popUp{position:absolute;z-index:10000}
.orderBx {background:#FFF !important}
</style>
</head>
<body>

    <div id="wrapper">
       <?php $this->load->view('include/inc_navigation'); ?>
       <div id="page-wrapper" class="gray-bg sidebar-content">
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
								
							    <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Cancel Order Information</div>
								
								<div class="ibox-content">

									<!-- Box -->
									    <div class="row" style="margin:10px 0 40px 0">
										
									     	<div class="col-lg-3"></div>
											
											<div class="col-lg-6">
												
												
												<div class="contact-box orderBx" style="border:2px solid #C80000">
													<a href="#">
														 <div class="col-sm-12">
															<div class="pull-left wdth100">
															  <div class="pull-left text-left lnehght30">Order #<?php echo $result['orderid']; ?></div>
															  <div class="pull-right text-right lnehght30 "><i class="fa fa-inr"></i> <?php echo $result['price']; ?> /-</div>
															</div>
															
															<div class="pull-left wdth100 pdbtm">
															   <div class="pull-left text-left lnehght24"><?php echo $result['otime']; ?> <br /><i class="fa fa-map-marker"></i> <?php echo $result['location']; ?><br /><i class="fa fa-user"></i> <?php echo ucwords($result['name']); ?></div>
															   
															   
															   <div class="pull-right text-right lnehght24"><?php echo $result['payment_method']; ?><br /><i class="fa fa-clock-o"></i> <span class=""><?php echo $result['time_diff']; ?></span></div>
															</div>
															
															<div class="pull-left wdth100 ordpend-line-dashed"></div>
															
															<div class="pull-left wdth100 lnehght40">Items (<?php echo $result['count']; ?>)</div>
															
															<div class="pull-left wdth100">
															
															   <div class="pull-left wdth80">
															   
															      <?php
																    if (count($result['orders']) > 0)
																		{
																			 foreach ($result['orders'] as $odata)
																					{
																						echo '<div class="pull-left wdth80 fdItem">
																								<div class="vegIcon"><i class="vg">&nbsp;</i>'.$odata['item'].'</div>
																								  <div class="vegIcon pull-left">
																									 <div class="text-left pull-left padleft20"><i class="fa fa-inr"></i> '.$odata['price'].' </div>
																								   <div class="qty text-center pull-right">'.$odata['qty'].'</div>
																								 </div>
																							  </div>';
																						echo '<div style="margin:6px 0" class="pull-left wdth100 ordpend-line-dashed"></div>';
																					}
																		}
																   
																  
																  ?>

																	  
															   </div>
																
															</div>
															
														</div>
														
														<div class="clearfix"></div>
													</a>
												</div>
												
												
												
											</div>
											
											<div class="col-lg-3"></div>
											
											
										</div>	
									
									
									<!-- close -->
								
								 
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
	
	
	<!-- Pop Up-->
	  
	  
	        <?php
			  //if (count(cancelled)
			?>
		
	        <!--<div style="background:url('../../assets/img/cross.png');background-repeat:no-repeat;background-position:center" id="morediv1" class="contact-box orderBx ">
			
			  <a href="#">
			     <div class="col-sm-12">
				    <div class="pull-left wdth100">
					  <div class="pull-left text-left lnehght30">Order #475</div>
					  <div class="pull-right text-right lnehght30 "><i class="fa fa-inr"></i> 12 /-</div>
					</div>
					
					<div class="pull-left wdth100 brdrlne pdbtm">
					   <div class="pull-left text-left lnehght24">10:59 am, 08 November 2016 <br><i class="fa fa-map-marker"></i> f<br><i class="fa fa-user"></i> aparna<br><i class="fa fa-user"></i> null</div>
					<div class="pull-right text-right lnehght24">Credit Purchase<br><i class="fa fa-clock-o"></i> <span class="ordrtm" id="ordrtm">-29:-35</span></div>
				    </div>
					
					<div class="pull-left wdth100 lnehght40">Items (4)</div>
					<div class="pull-left wdth100">
					  <div id="menuList" class="pull-left wdth80" data-attr="0">
					     <div class="pull-left wdth80 fdItem" style="display:block"><div class="vegIcon"><i class="vg">&nbsp;</i>Pizza<div class="qty text-center pull-right">1</div></div><div class="vegIcon pull-left"><div class="text-left pull-left padleft20"><i class="fa fa-inr"></i> 250 </div></div>
					  </div>
					  
					  <div class="pull-left hr-line-dashed wdth100"></div>
					    <div class="pull-left wdth80 fdItem" style="display:block">
					     <div class="vegIcon"><i class="vg">&nbsp;</i>Burger<div class="qty text-center pull-right">1</div></div>
						 
						 <div class="vegIcon pull-left"><div class="text-left pull-left padleft20"><i class="fa fa-inr"></i> 250 </div></div>
						</div>
						
						<div class="pull-left hr-line-dashed wdth100"></div>
						<div class="pull-left wdth80 fdItem" style="display:none"><div class="vegIcon"><i class="nonvg">&nbsp;</i>Chicken Burger<div class="qty text-center pull-right">1</div></div><div class="vegIcon pull-left"><div class="text-left pull-left padleft20"><i class="fa fa-inr"></i> 500 </div></div></div>
						
						<div class="pull-left hr-line-dashed wdth100"></div>
						
						<div class="pull-left wdth80 fdItem" style="display:none"><div class="vegIcon"><i class="nonvg">&nbsp;</i>Egg Roll<div class="qty text-center pull-right">5</div></div><div class="vegIcon pull-left"><div class="text-left pull-left padleft20"><i class="fa fa-inr"></i> 200 </div></div></div>
						
						<div class="pull-left hr-line-dashed wdth100"></div>
					  </div>
					</div>
				</div>
				<div class="clearfix"></div>
			 </a>
			</div>-->
			
			<div id="cancelledBox">
			
			</div>
			

	
	
	<!-- Close -->

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
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/icheck.min.js"></script>
	<script src="<?php echo config_item('base_url'); ?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

						
    </script>
	
	<script type="text/javascript">
	  
</script>

	
	
</body>


</html>
			