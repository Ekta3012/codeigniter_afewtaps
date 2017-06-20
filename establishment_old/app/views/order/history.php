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

.popUp{position:absolute;z-index:10000}
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

.popUp{position:absolute;z-index:10000}
.orderBx {background:#FFF !important}

#orderReason .orderBx {width:450px !important}
#orderReason .fdItem {display:block !important;padding-bottom:10px}
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


</style>
</head>
<body>
<?php 
//    echo '<pre>';
//    print_r($result['active_tab']);
//    echo '</pre>';
//    die();
?>
    <div id="fade" class="black_overlay"></div>

    <div id="wrapper">
       <?php $this->load->view('include/inc_navigation'); ?>
      <div id="page-wrapper" class="gray-bg sidebar-content">
       <div class="row border-bottom">
	   <?php $this->load->view('include/inc_topnav'); ?>
       </div>
	   
	   
        <div class="wrapper wrapper-content" id="leftWrapper" style="padding-right:0">
            <div class="row">
                 <!-- Table -->
				     <div class="col-lg-12">
							<div class="ibox float-e-margins">
							
							  <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;margin-bottom:20px"><?php echo ($result['tabel_heading'])?$result['tabel_heading']:""; ?></div>
							
								<div class="ibox-title">
									 
									 <?php echo form_open('order/history'); ?>
									 <div class="row">
										<div class="col-md-12">

										  <div class="col-md-2 input-group date" style="float:left;margin-right:3px">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date" class="form-control fnt12 padd2x5x" placeholder="Start Date" autocomplete="off" id="start_date" value="<?php echo $result['start_date']; ?>">
										  </div>
										  
										  <div class="col-md-2 input-group date" style="float:left;margin-right:3px">
											    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="end_date" class="form-control fnt12 padd2x5x" value="<?php echo $result['end_date']; ?>" autocomplete="off" placeholder="End Date" id="end_date">
										  </div>
							
							
							              <!-- <div class="col-md-2 input-group date" style="float:left;margin-right:3px">
											<input type="text" name="location" class="form-control fnt12 padd2x5x" value="" placeholder="Location" id="location"><span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
										  </div> -->
										  
										  <div class="col-md-2 input-group date" style="float:left;margin-right:3px">
											<input type="text" name="location" class="form-control fnt12 padd2x5x" value="<?php echo $result['location']; ?>" placeholder="Table # OR Seat #" autocomplete="off" id=""><span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
										  </div>
										  

										  <div class="col-md-2 input-group date" style="float:left;margin-right:3px">
											<input type="text" name="customer_name" class="form-control fnt12 padd2x5x" value="<?php echo $result['customer_name']; ?>" placeholder="Customer Name" autocomplete="off" id=""><span class="input-group-addon"><i class="fa fa-user"></i></span>
										  </div>
										  
										  
										  <div class="col-md-2 input-group date" style="float:left;margin-right:3px">
											<!--<input type="text" name="end_date1" class="form-control fnt12 padd2x5x" value="" placeholder="Payment Method" id="end_date1"><span class="input-group-addon"><i class="fa fa-inr"></i></span>-->
											
											<select class="form-control fnt12" name="payment_method">
											   <option value="2" <?php echo ($result['payment_method'] == 2) ? "selected='selected'": "" ; ?> >Cash on delivery</option>
											   <option value="3" <?php echo ($result['payment_method'] == 3) ? "selected='selected'": "" ; ?>>Payu</option>
											</select>
										  </div>
										  
										  
										  <div class="col-md-1 text-left" style="float:left;margin-right:3px">
											 <input type="submit" class="btn btn-primary" value="Filter" />
										  </div> 
										   
										   
										 </div>
									 </div>
									 
									<?php echo form_close(); ?>
									 
											
								</div>
								<div class="ibox-content">

									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover dataTables-example" >
										<thead>
										<tr>
											<th>S No</th>
											<th>Order #</th>
											<th>Time & Date</th>
											<th>Location</th>
											<th>Delivery Status</th>
											<th>Payment Method</th>
											<th>Amount</th>
											<th>Customer Name</th>
											<th>Receipt</th>
										</tr>
										</thead>
										<tbody>
										
										<?php
										   if (count($result['cancel_list']['result']) > 0)
											   {
												   $i = 0;
												   foreach ($result['cancel_list']['result'] as $data)
													   {
														   $i++;
														   switch ($data->status)
																{
																		case 1:
																				 $order_status = "In Preparation";
																				 $style = "style='color:#099e44'";
																				 break;
																		case 2:
																				 $order_status = "In Priority";
																				 $style = "style='color:#099e44'";
																				 break;
																		case 3:
																				 $order_status = "Completed";
																				 $style = "style='color:#099e44'";
																				 break;
																		case 4:
																				 $order_status = "Cancelled";
																				 $style = "style='color:#ff0014'";
																				 break;
																		case 5:
																				 $order_status = "In Priority";
																				 $style = "style='color:#099e44'";
																				 break;
																}
															
															switch ($data->payment_method)
																{
																	case 1:
																			   $payment  = "Credit Purchase";
																			   break;
																	case 2:
																			   $payment  = "Cash On Delivery";
																			   break;
																	case 3:
																			   $payment  = "Payu";
																			   break;	   
																}
											
														   echo '<tr class="">
																	<td>'.$i.'</td>
																	<td><a onclick="showPopUp('.$data->order_id.')" href="javascript:void(0)">'.$data->{'order_id'}.'</td>
																	<td>'.date('h:i a,M d Y', $data->order_time).'</td>
																	<td class="center">'.getOrderLocation($data->location).'</td>
																	<td class="center" '.$style.'>'.$order_status.'</td>
																	<td class="center">'.$payment.'</td>
																	<td class="center">Rs. '.$data->total_amount.' /-</td>
																	<td class="center">'.ucwords($data->sname).'</td>
																	<td class="center">View</td>
																 </tr>';
													   }
											   }
										   else
												   {
														   echo '<tr class="">
																	<td colspan=\'9\'>Sorry No Order Found .!</td>
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
		  if (count($result['orders_box']) > 0)
		    {
			   foreach ($result['orders_box'] as $result)
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
													 </div>
												  </div>';
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
	
	<script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
            });

            $('.dataTables_filter input').attr("placeholder", "Search By Order id, Amount...");

        });
	
		var width = $('#slide').width() - 10;
		$('#slide').hover(function () {
			 $(this).stop().animate({left:"0px"},500);     
		   },function () {          
			 $(this).stop().animate({left: - width  },500);     
		});
		
		
		
		$('#start_date, #end_date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
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
				// $("#orderCancelReason").css("display","block");
				
			}
			
	$(".black_overlay").click(function() {
			
			$('#fade').css('display','none');
			$('.popUp').attr('style','');
			$('.containerOrder').css('display','none');
			
		});


    </script>
	
</body>

</html>
			