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
<link href="<?php echo config_item('base_url'); ?>assets/css/awesome-bootstrap-checkbox.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/datatables.min.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/datepicker.css" rel="stylesheet">

<style>
.row.text-center {
    background-color: rgb(199, 199, 199);
    border-radius: 14px;
	 margin-bottom: 20px;
}
.row.text-center .active {
    background-color: rgb(42, 63, 84);
    border-radius: 7px;
    box-shadow: none !important;
    color: #fff;
    margin-top: 5px;
}
.nonactive{color:#000}
.total {
    border: 1px solid #888;
    border-radius: 4px;
    padding: 3px 8px;
}
.prce{
    border: 1px solid #888;
    border-radius: 4px;
    padding: 3px 8px;
}
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

.slides {
    width: 65%;
    overflow: auto;
	margin-top:20px
}
.slides ul {
    display: inline-block;
    height: 28px;
    white-space: nowrap;
}
.slides ul li {
    height: 100%;
    width: auto;
    display: inline-block;
    /*float: left;*/
    margin: 2px;
	margin:5px 10px;
	text-align:center;
	cursor:pointer
}

.vg{background:url('../../../assets/img/red_icon.png');background-repeat:no-repeat;width:20px;height:20px;float:left;background-position:center center}
.nonvg{background:url('../../../assets/img/green_icon.png');background-repeat:no-repeat;width:20px;height:20px;float:left;background-position:center center}


.addMenu{background:#2A3F54;color:#FFF}
.btn:focus, .btn:hover{color:#FFF}
.liactive {border-bottom:2px solid #404040;cursor:not-allowed !important}
.btn-w-m{min-width:0}


.badge1{background:url('../../assets/img/notification.png');background-repeat:no-repeat;float:right;background-position:center center;cursor:pointer;width:20px;height:20px;margin-top:10px;margin-bottom:10px}
.badge{margin-right:-5px;margin-top:-5px}
.lnehght30{line-height:30px}
.lnehght40{line-height:40px}
.lnehght24{line-height:24px}
.wdth100{width:100%}
.wdth80{width:80%}
.wdth20{width:20%}
.fdItem{margin-left:20px;margin-bottom:10px;border-bottom:1px solid #ddd}
.cfdItem{padding-bottom:10px;border-bottom:1px solid #ddd}
.orderBx{border:1px solid #888;border-radius:5px;padding:10px;margin-bottom:4px !important;min-height:310px;background-repeat:no-repeat}
.bold{font-weight:bold}
.fntsz{font-size:20px}
.extraseasoning {border:1px dashed #EAEAEA;line-height:24px;margin:10px 0}
.bordrseason{border:1px dashed #888}
.vg{background:url('../../assets/img/green_icon.png');background-repeat:no-repeat;width:20px;height:20px;float:left;background-position:center center}
.nonvg{background:url('../../assets/img/red_icon.png');background-repeat:no-repeat;width:20px;height:20px;float:left;background-position:center center}
.detailIconB{background:url('../../assets/img/arrowb.png');background-repeat:no-repeat;float:left;background-position:center right;cursor:pointer;width:50%}
.detailIconU{background:url('../../assets/img/arrowu.png');background-repeat:no-repeat;float:left;background-position:center right;cursor:pointer;width:50%}

.drnk{background:url('../../assets/img/black_icon.png');background-repeat:no-repeat;width:20px;height:20px;float:left;background-position:center center}

.detailIconR{background:url('../../assets/img/arrowr.png');background-repeat:no-repeat;float:left;background-position:center center}
.ordrtm,.offline{color:#c80000}
.mrgntp10_0{margin:10px 0}
.mrgnbtm20_0{margin:0 0 10px 0}

.cross{background:url('../../assets/img/cross.png');background-repeat:no-repeat;background-position:center center}
.sts{float:left;width:50%}

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



.popUp{position:absolute;z-index:10000}


#orderCancelReason .orderBx {width:450px !important}
#orderCancelReason .fdItem {display:block !important}


#orderReason #menuList {height:225px;overflow-y:scroll;overflow-x:none;width:100%}

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

.fnt12{font-size:12px}

</style>
</head>
<body>

<div id="fade" class="black_overlay"></div>

    <div id="wrapper">
       <?php $this->load->view('include/inc_navigation'); ?>
      <div id="page-wrapper" class="gray-bg sidebar-content">
       <div class="row border-bottom">
	   <?php $this->load->view('include/inc_topnav'); ?>
       </div>
		
        <div class="wrapper wrapper-content" style="padding-right:0">
            <div class="row">
                 <!-- Table -->
				     <div class="col-lg-12">
							<div class="ibox float-e-margins">	
							  <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Establishment Data</div>
								<div class="ibox-content">
							      <div class="row">
                                     <div class="col-md-4"></div>
                                        <div class="col-md-4">
									    <?php 
											$establishments = getAllEstablishments();
											if (count($establishments) > 0)
											  {
												 echo '<select class="form-control m-b" name="branch" onchange="branchStaff(this.value)">';
												 echo '<option value="">Select Establishment</option>';
												 foreach ($establishments as $edata)
												   {
													   $selected = ($this->uri->segment('3') == $edata->id) ? "selected='selected'" : "" ;
													   echo "<option $selected value='".$edata->id."'>".$edata->{'name'}."</option>";
												   }
												  echo '</select>';
											  }
										?>
                                        </div>
                                           
										<div class="col-md-4"></div>		   
								 </div>
								  
											  <?php
											    $segment = $this->uri->segment(2);
												 switch ($segment)
													 {
														  case 'order':
																	$orderitem    = 'active';
																	break;
														case 'inside':
																	$insideitem    = 'active';
																	break;
														case 'analytics':
																	$analyticsitem    = 'active';
																	break;
														case 'ratings':
																	$ratingsitem    = 'active';
																	break;
														case 'menu/1':
																	$menuitem    = 'active';
																	break;
														
														case 'merchant':
																	$merchantinfor    = 'active';
																	break;
																	
													 }
											  ?>
								  <div class="row text-center">
                                    <a href="<?php echo base_url(); ?>index.php/establishmentdata/order/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($orderitem) ? $orderitem : "nonactive" ; ?>" data-attr="order" type="button">Order History</button></a>
                                  
                                    <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($insideitem) ? $insideitem : "nonactive" ; ?>" data-attr="inside" type="button">Inside Information</button></a>
                                    <a href="<?php echo base_url(); ?>index.php/establishmentdata/analytics/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($analyticsitem) ? $analyticsitem : "nonactive" ; ?>" data-attr="analytics" type="button">Analytics</button></a>
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/ratings/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($ratingsitem) ? $ratingsitem : "nonactive" ; ?>" data-attr="ratings" type="button">Ratings</button></a>
                                    
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/menu/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($menuitem) ? $menuitem : "nonactive" ; ?>" data-attr="menu/1" type="button">Menu Items</button></a>
									 
									 <a href="<?php echo base_url(); ?>index.php/establishmentdata/location"><button class="btn <?php echo isset($locationitem) ? $locationitem : "nonactive" ; ?>" data-attr="menu/1" type="button">Location</button></a>
									        
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/merchant/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($merchantinfor) ? $merchantinfor : "nonactive" ; ?>" data-attr="merchant" type="button">Merchant Information</button></a>
								  </div>
								  
								  
								<?php echo validation_errors(); ?>
								<?php echo form_open('establishmentdata/order/'.$this->uri->segment(3), array('class' => 'form-horizontal')); ?>
							  	<div class="row" style="margin-bottom:20px">
								
								<div class="col-md-12">

								   <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
										<input type="text" name="start_date" class="form-control" placeholder="Start Date" id="start_date"value="<?php echo set_value('start_date'); ?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								   </div>
								  
								   <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
									<input value="<?php echo set_value('end_date'); ?>" type="text" name="end_date" class="form-control" value="" placeholder="End Date" id="end_date"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								   </div>
					
				  
								  <div class="col-md-3 text-left" style="float:left;margin-right:10px">
									 <input type="submit" class="btn btn-primary" value="Filter" />
								  </div>   
								   
								 </div>
									
								</div>
								
								<?php echo form_close(); ?>
							
                                    
									
									
                                    
                           
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover dataTables-example" >
											<thead>
												<tr style="font-size:12px">
													<th>S No</th>
													<th>Order #</th>
													<th>Time &amp; Date</th>
													<th>Location</th>
													<th>Delivery Status</th>
													<th>Payment Method</th>
													<th>Amount</th>
													<th>Customer Name</th>
												</tr>
											</thead>
												
												<tbody>
												
												<?php 
													 if (count ($order) > 0)
													  {
														  $i = 1;
														  foreach ($order as $ordata)
															   {
																   $pay_code      =  $ordata->payment_method;
																   $paymnt_method = ($pay_code == 1) ? "Credit Purchase" : (($pay_code == 2) ? "COD" : "Instamojo");
																   
																   switch ($ordata->{'status'})
																	 {
																		case 1 :
																					$status = "In Preparation";
																					break;
																		case 2 :
																					$status = "In Priority";
																					break;
																		case 3 :
																					$status = "Completed";
																					break;
																		case 4 :
																					$status = "Cancelled";
																					break;
																		case 5 :
																					$status = "Threshold";
																					break;
																	   
																	  }
																	  
																	  if (empty($ordata->staff_member_id))
																	  $order_status = 'Waiting for acceptance';
																	 
																	echo '<tr class="">
																			<td>'.$i.'</td>
																			<td><a onclick="showPopUp('.$ordata->order_id.')" href="javascript:void(0)">'.$ordata->{'order_id'}.'</a></td>
																			<td>'.date('h:i A, M d Y', $ordata->order_time).'</td>
																			<td>'.getOrderLocation($ordata->location).'</td>
																			<td>'.$status.'</td>
																			<td>'.$paymnt_method.'</td>
																			<td>'.$ordata->total_amount.'</td>
																			<td>'.$ordata->name.'</td>
																		 </tr>';
																		 $i++;
															  }	  	   
													  }
													  else
																   {
																		   echo '<tr class="">
																					<td colspan=\'9\'>No Data.</td>
																				 </tr>';
																   }	
											?>
											 
												</tbody>
									  </table>
									</div>
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
	   
	   
	   
	   
	   
	   <div id="orderReason" class='popUp'>
		<?php
		  if (count($order_box) > 0)
		    {
			   foreach ($order_box as $result)
			      {	  
	    ?>
			 <div class='containerOrder' id="orderBoxContainer<?php echo $result['orderid']; ?>" style="display:none">
				<div class="contact-box orderBx">
					<a href="#">
						 <div class="col-sm-12">
							<div class="pull-left wdth100">
							  <div class="pull-left text-left lnehght30">Order #<?php echo $result['orderid']; ?></div>
							  <div class="pull-right text-right lnehght30 "><i class="fa fa-inr"></i> <?php echo $result['price']; ?> /-</div>
							</div>
							
							<div class="pull-left wdth100 pdbtm">
							   <div class="pull-left text-left lnehght24"><?php echo $result['otime']; ?> <br /><i class="fa fa-map-marker"></i> <?php echo getOrderLocation($result['location']); ?><br /><i class="fa fa-user"></i> <?php echo ucwords($result['name']); ?></div>
							   
							   
							   <div class="pull-right text-right lnehght24"><?php echo $result['payment_method']; ?><br /><i class="fa fa-clock-o"></i> <span class=""><?php echo $result['time_diff']; ?></span></div>
							</div>
							
							<div class="pull-left wdth100 ordpend-line-dashed"></div>
							
							<div class="pull-left wdth100 lnehght40">Items (<?php echo count($result['orders']); ?>)</div>
							
							<div class="pull-left wdth100">
							
							   <div class="pull-left wdth80" id="menuList">
							   
								  <?php
									foreach ($result['orders'] as $odata)
										{
											echo '<div class="pull-left wdth80 fdItem">
													<div class="vegIcon"><i class="vg">&nbsp;</i>'.$odata['item'].'</div>
													  <div class="vegIcon pull-left">
														 <div class="text-left pull-left padleft20"><i class="fa fa-inr"></i> '.$odata['price'].' </div>
													   <div class="qty text-center pull-right">'.$odata['qty'].'</div>
													 </div>';
													 
													 if (is_array($odata['customization']) && count($odata['customization']) > 0)
																 {
																	 foreach ($odata['customization'] as $fdata)
																	 echo '<div class="pull-left" style="padding-left:25px">'.$fdata['name'].' - '.$fdata['options'].'</div>';
																 }
															 
														  echo '</div>';
										}
								  ?>
 
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
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/datatables.min.js"></script>
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/datepicker.js"></script>
    <script src="<?php echo config_item('base_url'); ?>assets/js/switchery.js"></script>
    
    <script>
	
	
	    $(document).ready(function(){
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: []
            });
			$('.dataTables_filter input[type="search"]').attr('placeholder','Search by any field');	
        });
		
		
		
		
        $(document).ready(function(){
			
			var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });			
			
           
			
				


        });
		
    </script>
    
 <script>
	$(document).ready(function(){
$('#start_date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#end_date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
        });
	</script>
	
	<script>
		function branchStaff(value)
			{
				location.href = "<?php echo base_url(); ?>index.php/establishmentdata/order/" + value;
			}
			
			
			
		$(".black_overlay").click(function() {
			
			$('#fade').css('display','none');
			$('.popUp').attr('style','');
			$('.containerOrder').css('display','none');
			
		});
		
	
		function showPopUp(id)
			{
				$('#fade').css('display','block');

				var hh=$(document).height();
				
				$(".black_overlay").css('height',hh);
				$(".black_overlay").css('width',$(document).width());
				
				var w  = $(window).width()/2;
				
				var h  = $(window).height()/2;
				
				var wh = 225; //$('.popUp').width()/2;
				var he = $('.popUp').height()/2;
				
				var fw = w-wh;
				var fh = h-he;
				
				$('.popUp').css('right',fw);
				$('.popUp').css('top',10);
				$("#orderBoxContainer" + id).css("display","block");
			}
			
			
    </script>
	
</body>

</html>
			