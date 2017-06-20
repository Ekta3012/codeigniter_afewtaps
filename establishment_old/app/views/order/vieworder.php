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
<link href="<?php echo config_item('base_url'); ?>assets/css/datatables.min.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/datepicker.css" rel="stylesheet">
	
<style>
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
	   
	     <div id="toggle" style="display:none;position:absolute;right:230px;top:60px;text-align:right"><a href="javascript:void(0);" style="cursor:pointer"><strong>Hide</strong></a></div>
		 
		  <div class="badge1" id="badgeCount"><span id="notfiyCount" style="cursor:pointer" class="badge badge-info pull-right"></span></div>
		
	     <div class="sidebard-panel" style="display:none">
                <?php $this->load->view('include/inc_sidebar'); ?>
         </div>
		
		 <?php
		 
		     $cancelled = $this->input->get('cancelled');
			 if ($cancelled)
				 {
					 $all = 'class=""';
					 $cancelled = 'class="active"';

					 $cactive = 'active';
					 $aactive = '';
				 }
			else
				{
					$all = 'class="active"';
					$cancelled = '';
					
					$cactive = '';
					$aactive = 'active';
				}
		 
		 ?>
		 
        <div class="wrapper wrapper-content" id="leftWrapper" style="padding-right:0;padding-top:30px">
            <div class="row">
                 <!-- Table -->
				     <div class="col-lg-12">
							<div class="ibox float-e-margins">
								
							    <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Order Information</div>
								
								<div class="ibox-content">

									<!-- Tab -->
									
									<div class="tabs-container">
										<ul class="nav nav-tabs order_nav">
											<li <?php echo $all; ?>  style="padding:0 25px"><a id="allTab" href="#tab-1" data-toggle="tab" aria-expanded="false">All</a></li>
											
											<li class="" style="padding:0 25px"><a href="#tab-2" id="newTab" data-toggle="tab" aria-expanded="true">New</a><span class="" id="newBadge"></span></li>
											
											<li class="" style="padding:0 25px"><a href="#tab-3" id="pendingTab" data-toggle="tab" aria-expanded="true">Pending</a><span class="" id="pendingBadge"></span></li>
											
											<li <?php echo $cancelled; ?> style="padding:0 25px"><a href="<?php echo base_url(); ?>index.php/order/view?cancelled=1" >Cancelled</a></li>
											
										</ul>
										
										<div class="tab-content">
											<div class="tab-pane <?php echo $aactive; ?>" id="tab-1">
												<div class="panel-body" id="allOrders">
													<!--  Container -->
													just a moment...
												</div>
											</div>
											<div class="tab-pane" id="tab-2">
												<div class="panel-body" id="preparation">
												  just a moment...
												</div>
											</div>
											
											<div class="tab-pane" id="tab-3">
												<div class="panel-body" id="priority">
												  just a moment...
												</div>
											</div>
											
											<div class="tab-pane <?php echo $cactive; ?>" id="tab-4">
												<div class="panel-body" id="cancelled">
												  <!-- Table -->
												  
												  <div class="" style="margin:20px 0">
									 
									                 <?php echo form_open('order/view?cancelled=1'); ?>
													
													 <div class="row">
														<div class="col-md-12">

														  <div class="col-md-3 input-group date" style="float:left;margin-right:3px">
																<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="start_date" class="form-control fnt12" placeholder="Start Date" autocomplete="off" id="start_date" value="" type="text">
														  </div>
														  
														  <div class="col-md-3 input-group date" style="float:left;margin-right:3px">
																<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="end_date" class="form-control fnt12 padd2x5x" value="" autocomplete="off" placeholder="End Date" id="end_date" type="text">
														  </div>
											
														  <div class="col-md-2 text-left" style="float:left;margin-right:3px">
															 <input class="btn btn-primary" value="Filter" type="submit">
														  </div> 
														   
														 </div>
													 </div>
													 
													<?php  echo form_close(); ?>							 
											
								</div>
															 
												  <div class="table-responsive">
													<table class="table table-striped table-bordered table-hover dataTables-example" >
														<thead>
															<tr style="font-size:11px">
																<th>S No</th>
																<th>Order #</th>
																<th>Time & Date</th>
																<th>Customer Name</th>
																<th>Email Id</th>
																<th>Mobile No</th>
																<th>Reason for Cancellation</th>
																<th>Cancelled By</th>
															</tr>
														</thead>
														<tbody>
												
														<?php

														   if (count($cancelled_orders['res']) > 0)
															   {
																   $i = 0;
																    
																   foreach ($cancelled_orders['res'] as $data)
																	   {  
																		   if ($data->user_flag == 1)
																			   {
																				   $customer_id = $this->db->select('customer_id')->get_where($this->db->dbprefix('order'))->row()->customer_id;
																				   
																				   $cancel_by = $this->db->select('name')->get_where($this->db->dbprefix('accounts'), array('id' => $customer_id))->row()->name;
																			   }
																	  
																	       if ($data->server_flag == 1)
																		    {
																			    $staff_id = $this->db->select('staff_member_id')->get_where($this->db->dbprefix('order'))->row()->staff_member_id;
																				   
																			    $cancel_by = $this->db->select('name')->get_where($this->db->dbprefix('staff_member'), array('id' => $staff_id))->row()->name;
																		    }
																		   
																		   //<a href="'.base_url().'index.php/order/cancel/'.$data->order_id.'" target="_blank">'.$data->order_id.'</a></td>
																		   
																		   
																		   echo '<tr class="">
																					<td>'.++$i.'</td>
																					<td><a onclick="showPopUp('.$data->order_id.')" href="javascript:void(0)">'.$data->order_id.'</a></td>
																					<td>'.date('h:i a,M d Y', $data->order_time).'</td>
																					<td class="center">'.$data->sname.'</td>
																					<td class="center">'.$data->email.'</td>
																					<td class="center">'.$data->contactno.'</td>
																					<td class="center">'.$data->reason.'</td>
																					<td class="center">'.ucwords($cancel_by).'</td>
																				 </tr>';
																	   }
															   }
														   else
																   {
																		   echo '<tr class="">
																					<td colspan=\'9\'>Sorry No Cancelled Order Found .!</td>
																				 </tr>';
																   }   
														?>
												
												
															</tbody>

														</table>
													</div>
								
									
												</div>
											</div>
										</div>

									</div>
									
									
									<!-- tab close -->
									
									
									<!-- floor performace -->
									

									 <div class="row mrgntp10_0">
										    <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Floor Performance</div>
										        <div class="row">
										        
													  <div class="col-lg-3">
															 <!-- Slider -->
															 <div class="pull-left text-center" style="width:100%;margin:0 15px">
																<div class="text-center" style="font-size:18px;margin-top:185px;">
																	<div class="fntsze13 text-center" style="border:1px solid #888;">No of Orders</div>
																	 <div class="fntsze13 text-center" style="border-left:1px solid #888;border-right:1px solid #888;">Average time (m:s)</div>
																	 <div class="fntsze13 text-center" style="border:1px solid #888;">Amount <i class="fa fa-inr"></i></div>
																</div>	
															 </div>
													  </div>
													  
													  <div class="col-lg-9">
													  
													  
														 <div class="row inner horizontal-images" style="overflow:hidden;">
															  <!-- Slider -->
															  <div class="floorContainer" style="width:1325px;height:320px;margin-top:8px" id="floorContainer">
															
															  </div>
															  
															  <!-- Close slider-->
															  
														 </div>
													  </div>
												  </div>
										   
									 </div>
									 
					
									<!-- Close -->
								 
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
		
		
				<div id="orderCancels" class='popUp'>
				   <?php 
				    if (count($cancelled_orders['orders']) > 0)
						   {
							   $i = 0;
							   foreach ($cancelled_orders['orders'] as $result)
								   {  		   
					?>
										<div class="contact-box orderBx cnclBx" style="display:none" id="cancelBox<?php echo $result['oid']; ?>">
											<a href="#">
												 <div class="col-sm-12">
													<div class="pull-left wdth100">
													  <div class="pull-left text-left lnehght30">Order #<?php echo $result['oid']; ?></div>
													  <div class="pull-right text-right lnehght30 "><i class="fa fa-inr"></i> <?php echo $result['prc']; ?> /-</div>
													</div>
													
													<div class="pull-left wdth100 pdbtm">
													   <div class="pull-left text-left lnehght24"><?php echo $result['otm']; ?> <br /><i class="fa fa-map-marker"></i> <?php echo getOrderLocation($result['loc']); ?><br /><i class="fa fa-user"></i> <?php echo ucwords($result['nm']); ?></div>
													   
													   
													   <div class="pull-right text-right lnehght24"><?php echo $result['pm']; ?><br /><i class="fa fa-clock-o"></i> <span class=""><?php echo $result['tmr']; ?></span></div>
													</div>
													
													<div class="pull-left wdth100 ordpend-line-dashed"></div>
													
													<div class="pull-left wdth100 lnehght40">Items (<?php echo $result['cnt']; ?>)</div>
													
													<div class="pull-left wdth100">
													
													   <div class="pull-left wdth80" style="margin-left:10px" id="menuList" data-attr="0">
													   
														  <?php
														    $cnt = 0;
															if (count($result['ord']) > 0)
																{
																	 foreach ($result['ord'] as $odata)
																			{
																				$style = ($cnt > 1) ? "style='display:none'":""; 
																				echo '<div class="pull-left wdth80 cfdItem" '.$style.'>
																						<div class="vegIcon"><i class="vg">&nbsp;</i>'.$odata['item'].'</div>
																						  <div class="vegIcon pull-left">
																							 <div class="text-left pull-left padleft20"><i class="fa fa-inr"></i> '.$odata['price'].' </div>
																						   <div class="qty text-center pull-right">'.$odata['qty'].'</div>
																						 </div>
																					  </div>';
																				$cnt++;
																			}
																}
																
															if ($result['cnt'] > 2)
														    echo '<div class="pull-left wdth100"><span id="cancelToggle'.$result['oid'].'" onclick="showContainerData('.$result['oid'].')" class="detailIconB wdth100 text-center">&nbsp;</span></div>';
														   
														  
														  ?>

															  
													   </div>
														
													</div>
													
												</div>
												
												<div class="clearfix"></div>
											</a>
										</div>
						   <?php } } ?>
				</div>
		
		
		
		
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
	<script src="<?php echo config_item('base_url'); ?>assets/js/datatables.min.js"></script>
	<script src="<?php echo config_item('base_url'); ?>assets/js/datepicker.js"></script>

	
	<script>
	
        $(document).ready(function() {
			
			<?php
				if (count($cancelled_orders['res']) > 0)
				{
		    ?>										   
				$('.dataTables-example').DataTable({
					dom: '<"html5buttons"B>lTfgitp',
					buttons: [
					]
				});
				$('.dataTables_filter input').attr("placeholder", "Search By Order id, Amount..");
			<?php } ?>
								
				$('#start_date, #end_date').datepicker({
					todayBtn: "linked",
					keyboardNavigation: false,
					forceParse: false,
					calendarWeeks: true,
					autoclose: true,
					todayHighlight: true
				});
				
				loadAllOrders();
				
				setInterval(function(){ checkActiveTab() }, 3000);
				
				$.mCustomScrollbar.defaults.theme="inset"; //set "inset" as the default theme
				$.mCustomScrollbar.defaults.scrollButtons.enable=true; //enable scrolling buttons by default
				
				$(".inner.horizontal-images").mCustomScrollbar({
					axis:"x",
					advanced:{autoExpandHorizontalScroll:true}
				});
				
        });
		
		
		$('#allTab').on('click', function() {
			loadAllOrders();
		});
		
		
		$('#newTab').on('click', function() {
			loadNewOrders();
		});
		
		$('#pendingTab').on('click', function() {
			loadPendingOrders();
		});
		
		
		function checkActiveTab()
			{
				 var activeTab = $('div.tabs-container ul li.active a').html();
				 switch (activeTab) {
					 case 'All':
										loadAllOrders();
										break;
					 case 'New':
										loadNewOrders();
										break;
					 case 'Pending':
										loadPendingOrders();
										break;
				 }
				  
			}
		
		function loadAllOrders()
	     	{
		        $.ajax({
					       url: "<?php echo base_url(); ?>index.php/order/homePageAllOrder/<?php echo $estabid; ?>",
						   type:"GET",
						   dataType:"json",
						   async: false,
						   success:function(P) 
						      { 
							    var Z   = 0;
								
								if (P.new_order_count > 0)
								$("#newBadge").addClass('badgecount').html(P.new_order_count);
							
							    if (P.pending_order_count > 0)
								$("#pendingBadge").addClass('badgecount').html(P.pending_order_count);

							    var data = P.result.allOrders;

								if (typeof(data) != "undefined" && data != "")
								   {
									    var H = '';
										var G = 0;
										var I = 0;
										
										$.each(data, function(E,F)
										    {
												if (G == 0)
												H  += '<div style="margin:10px 0 40px 0" class="row">';
											
											    G = G + 1;

												H  += '<div class="col-lg-6">';
												
												switch (parseInt(F.sts))
													 {
														 case 1:
																	var status = "In Preparation";
																	if (F.nw_ord_flg == 0)
																	var style = "style=\"background-color:#f4f4f4\"";
																	break;
																	
														 case 2:
														 case 5:
																	var status = "In Priority";
																	var style = "style=\"border:1px solid #FF0000\"";
																	break;
																	
														 case 3:
																	var status = "Completed";
																	break;
														
														 case 4:
																	var status = "Cancelled";
																	var style  = "style=\"border:1px solid #888;background:url(\'../../assets/img/cross.png\') !important;background-repeat:no-repeat !important;background-position:center !important\"";
																	break;																				
													 }
													 
												   
												   if (F.snm !== '')
												   var sname = '<br /><i class="fa fa-user"></i> ' + F.snm + ' is serving you';
													   else
												   var sname = '<br /><i class="fa fa-user"></i> Waiting for acceptance';

												   H += '<div id="morediv' + Z + '" class="contact-box orderBx" ' + style + '><a href="#"><div class="col-sm-12"><div class="pull-left wdth100"><div class="pull-left text-left lnehght30">Order #' + F.oid + '</div><div class="pull-right text-right lnehght30 "><i class="fa fa-inr"></i> ' + F.prc + ' /-</div></div><div class="pull-left wdth100 brdrlne pdbtm"><div class="pull-left text-left lnehght24">' + F.otm + ' <br><i class="fa fa-map-marker"></i> ' + F.loc + '<br><i class="fa fa-user"></i> <span style="color:blue">' + F.nm + '</span>' + sname + '</div><div class="pull-right text-right lnehght24">' + F.pm + '<br><i class="fa fa-clock-o"></i> <span class="ordrtm" id="ordrtm">' +  F.tmr +  '</span></div></div><div class="pull-left wdth100 lnehght40">Items (' + F.cnt + ')</div><div class="pull-left wdth100"><div id="menuList" class="pull-left wdth80" data-attr="0">';

												   var S = 0;	
												   $.each(F.ord, function(J,K)
													 {
														 S++;
														 var ico = (K.type == 1) ? "vg" : ((K.type == 2) ? "nonvg" : "drnk");
														 
														 var ds  = (S > 2) ? "none" : "block"; 
														 H +=  '<div class="pull-left wdth80 fdItem" style="display:' + ds + '"><div class="vegIcon"><i class="' + ico + '">&nbsp;</i>' + K.item + '<div class="qty text-center pull-right">' + K.qty + '</div></div><div class="vegIcon pull-left"><div class="text-left pull-left padleft20"><i class="fa fa-inr"></i> ' + K.price + ' </div></div></div>';
													 });
																		   
														 H += '</div></div></div><div class="clearfix"></div></a></div>';
														 
														 
														 if (F.snm == '' && F.sts != 4)
															 status = 'Waiting for acceptance';
														 
														 if (S > 2)
														 H += '<div class="pull-left wdth100"><span id="more' + Z + '" onclick="showContainer(' + Z +')" class="detailIconB text-center">&nbsp;</span><span class="fnt12 text-right wdth100 bold mrgnbtm20_0 sts">Order Status: ' + status + '</span></div>';
													     else
														 H += '<div class="pull-left wdth100"><span style="width:50%;float:left" id="" onclick="" class="">&nbsp;</span><span class="fnt12 text-right wdth100 bold mrgnbtm20_0 sts">Order Status: ' + status + '</span></div>';	 
														 
														 
														 H +=  '</div>';
														 
														 I = I + 1;	
														 
														 Z = Z + 1;
														 
														 if (I % 2 == 0)
														  {
															  H += '</div>';
															  G = 0;
														  }	
												});
														if (I % 2 != 0)
														   {
															   H  += '</div>';
														   }
															   $("#allOrders").html(H);
											}
									else
												{
														 $("#allOrders").html("Sorry! No Order Found.");
												}
														 staffPerformance(P.staff);
					        }
					  });
		    }
			
			
	    function staffPerformance(staff_performace_data)
			{
				var stf = "";
				$.each(staff_performace_data, function (V,R) 
				  {
					 var img  = (R.pic != '') ? R.pic : 'user.png';
					 var o    = (R.online == 1) ? "online" : "offline";
					 var clr  = (R.online == 1) ? "" : "style='color:#FF0000'";
					 
stf += '<div class="flrbox" style=""><div class="text-center mrgn15"><img class="img-circle" width="57" height="57" src="<?php echo base_url(); ?>../uploads/' + img + '" /></div><div class="text-center mrgn15 fntsze10" style=""><img src="<?php echo base_url(); ?>assets/img/' + o + '.png" /> <span ' + clr + '>' + o.substr(0,1).toUpperCase()+o.substr(1) + '</span></div><div class="text-center mrgn25 clr666" style="font-size:18px">' + R.name + '</div><div class="text-center mrgn25" style="font-size:18px"><div class="fntsze13" style="border:1px solid #888;">' + R.nooforders + '</div><div class="fntsze13" style="border-left:1px solid #888;border-right:1px solid #888;">' + R.avg_time + '</div><div class="fntsze13" style="border:1px solid #888;"><i class="fa fa-inr"></i> ' + R.price + '</div><div class="fntsze13" style="margin-top:30px"><a target="_blank" href="<?php echo base_url(); ?>index.php/staff/view"><i class="fa fa-user"></i> View Profile</a></div><div class="fntsze13" style="margin-top:10px;padding-left:10px"><a target="_blank" href="<?php echo base_url(); ?>index.php/analytics/staffAnalytics/' + R.id + '"><i class="fa fa-bar-chart"></i> View Analytics</a></div></div></div>';
				  });
				  
					 $('#floorContainer').html(stf);			 
			}
			
		function loadNewOrders()
	        {
				$.ajax({
					       url: "<?php echo base_url(); ?>index.php/order/homePageNewOrder/<?php echo $estabid; ?>",
						   type:"GET",
						   dataType:"json",
						   async: false,
						   success:function(P) 
						      { 
							    var Z   = 0;
								
								if (P.new_order_count > 0)
								$("#newBadge").addClass('badgecount').html(P.new_order_count);
							
							    if (P.pending_order_count > 0)
								$("#pendingBadge").addClass('badgecount').html(P.pending_order_count);

							    var data = P.result.newOrders;

								if (typeof(data) != "undefined" && data != "")
								   {
									    var H = '';
										var G = 0;
										var I = 0;
										
										$.each(data, function(E,F)
										    {
												if (G == 0)
												H  += '<div style="margin:10px 0 40px 0" class="row">';
											
											    G = G + 1;

												H  += '<div class="col-lg-6">';
												
												
												switch (parseInt(F.sts))
													 {
														 case 1:
																	var status = "In Preparation";
																	if (F.nw_ord_flg == 0)
																	var style = "style=\"background-color:#f4f4f4\"";
																	break;
																	
														 case 2:
														 case 5:
																	var status = "In Priority";
																	var style = "style=\"border:1px solid #FF0000\"";
																	break;
																	
														 case 3:
																	var status = "Completed";
																	break;
														
														 case 4:
																	var status = "Cancelled";
																	var style  = "style=\"border:1px solid #888;background:url(\'../../assets/img/cross.png\');background-repeat:no-repeat;background-position:center\"";
																	break;																				
													 }
													 
												   
												   if (F.snm !== '')
												   var sname = '<br /><i class="fa fa-user"></i> ' + F.snm + ' is serving you';
													   else
												   var sname = '<br /><i class="fa fa-user"></i> Waiting for acceptance';

												   H += '<div id="morediv' + Z + '" class="contact-box orderBx"' + style + '><a href="#"><div class="col-sm-12"><div class="pull-left wdth100"><div class="pull-left text-left lnehght30">Order #' + F.oid + '</div><div class="pull-right text-right lnehght30 "><i class="fa fa-inr"></i> ' + F.prc + ' /-</div></div><div class="pull-left wdth100 brdrlne pdbtm"><div class="pull-left text-left lnehght24">' + F.otm + ' <br><i class="fa fa-map-marker"></i> ' + F.loc + '<br><i class="fa fa-user"></i> <span style="color:blue">' + F.nm + '</span>' + sname + '</div><div class="pull-right text-right lnehght24">' + F.pm + '<br><i class="fa fa-clock-o"></i> <span class="ordrtm" id="ordrtm">' +  F.tmr +  '</span></div></div><div class="pull-left wdth100 lnehght40">Items (' + F.cnt + ')</div><div class="pull-left wdth100"><div id="menuList" class="pull-left wdth80" data-attr="0">';
												   

												   var S = 0;	
												   $.each(F.ord, function(J,K)
													 {
														 S++;
														 var ico = (K.type == 1) ? "vg" : ((K.type == 2) ? "nonvg" : "drnk");
														 
														 var ds  = (S > 2) ? "none" : "block"; 
														 H +=  '<div class="pull-left wdth80 fdItem" style="display:' + ds + '"><div class="vegIcon"><i class="' + ico + '">&nbsp;</i>' + K.item + '<div class="qty text-center pull-right">' + K.qty + '</div></div><div class="vegIcon pull-left"><div class="text-left pull-left padleft20"><i class="fa fa-inr"></i> ' + K.price + ' </div></div></div>';
													 });
																		   
														 H += '</div></div></div><div class="clearfix"></div></a></div>';
														 
														 if (F.snm == '' && F.sts != 4)
														 status = 'Waiting for acceptance';
														 
														 if (S > 2)
														 H += '<div class="pull-left wdth100"><span id="more' + Z + '" onclick="showContainer(' + Z +')" class="detailIconB text-center">&nbsp;</span><span class="fnt12 text-right wdth100 bold mrgnbtm20_0 sts">Order Status: ' + status + '</span></div>';
													     else
														 H += '<div class="pull-left wdth100"><span style="width:50%;float:left" id="" onclick="" class="">&nbsp;</span><span class="fnt12 text-right wdth100 bold mrgnbtm20_0 sts">Order Status: ' + status + '</span></div>';	 
														 
														 H +=  '</div>';
														 
														 I = I + 1;	
														 
														 Z = Z + 1;
														 
														 if (I % 2 == 0)
														  {
															  H += '</div>';
															  G = 0;
														  }	
												});
														if (I % 2 != 0)
														   {
															   H  += '</div>';
														   }
															   $("#preparation").html(H);
											}
									else
												{
														 $("#preparation").html("Sorry! No Order Found.");
												}
														 staffPerformance(P.staff);
					        }
					  });
					  
					  
					  
					  
		       
		    }
			
		function loadPendingOrders()
			{
				
				$.ajax({
					       url: "<?php echo base_url(); ?>index.php/order/homePagePendingOrder/<?php echo $estabid; ?>",
						   type:"GET",
						   dataType:"json",
						   async: false,
						   success:function(P) 
						      { 
							    var Z   = 0;
								if (P.new_order_count > 0)
								$("#newBadge").addClass('badgecount').html(P.new_order_count);
							
							    if (P.pending_order_count > 0)
								$("#pendingBadge").addClass('badgecount').html(P.pending_order_count);

							    var data = P.result.pendingOrders;

								if (typeof(data) != "undefined" && data != "")
								   {
									    var H = '';
										var G = 0;
										var I = 0;
										
										$.each(data, function(E,F)
										    {
												if (G == 0)
												H  += '<div style="margin:10px 0 40px 0" class="row">';
											
											    G = G + 1;

												H  += '<div class="col-lg-6">';
												switch (parseInt(F.sts))
													 {
														 case 1:
																	var status = "In Preparation";
																	var style = "style=\"background-color:#f4f4f4\"";
																	break;
																	
														 case 2:
														 case 5:
																	var status = "In Priority";
																	var style = "style=\"border:1px solid #FF0000\"";
																	break;
																	
														 case 3:
																	var status = "Completed";
																	break;
														
														 case 4:
																	var status = "Cancelled";
																	var style  = "style=\"border:1px solid #888;background:url(\'../../assets/img/cross.png\');background-repeat:no-repeat;background-position:center\"";
																	break;																				
													 }
													 
												   if (F.snm !== '')
												   var sname = '<br /><i class="fa fa-user"></i> ' + F.snm + ' is serving you';
													   else
												   var sname = '<br /><i class="fa fa-user"></i> Waiting for acceptance';

												   H += '<div id="morediv' + Z + '" class="contact-box orderBx" ' + style + '><a href="#"><div class="col-sm-12"><div class="pull-left wdth100"><div class="pull-left text-left lnehght30">Order #' + F.oid + '</div><div class="pull-right text-right lnehght30 "><i class="fa fa-inr"></i> ' + F.prc + ' /-</div></div><div class="pull-left wdth100 brdrlne pdbtm"><div class="pull-left text-left lnehght24">' + F.otm + ' <br><i class="fa fa-map-marker"></i> ' + F.loc + '<br><i class="fa fa-user"></i> <span style="color:blue">' + F.nm + '</span>' + sname + '</div><div class="pull-right text-right lnehght24">' + F.pm + '<br><i class="fa fa-clock-o"></i> <span class="ordrtm" id="ordrtm">' +  F.tmr +  '</span></div></div><div class="pull-left wdth100 lnehght40">Items (' + F.cnt + ')</div><div class="pull-left wdth100"><div id="menuList" class="pull-left wdth80" data-attr="0">';
												   

												   var S = 0;	
												   $.each(F.ord, function(J,K)
													 {
														 S++;
														 var ico = (K.type == 1) ? "vg" : ((K.type == 2) ? "nonvg" : "drnk");
														 
														 var ds  = (S > 2) ? "none" : "block"; 
														 H +=  '<div class="pull-left wdth80 fdItem" style="display:' + ds + '"><div class="vegIcon"><i class="' + ico + '">&nbsp;</i>' + K.item + '<div class="qty text-center pull-right">' + K.qty + '</div></div><div class="vegIcon pull-left"><div class="text-left pull-left padleft20"><i class="fa fa-inr"></i> ' + K.price + ' </div></div></div>';
													 });
																		   
														 H += '</div></div></div><div class="clearfix"></div></a></div>';
														 
														 if (F.snm == '' && F.sts != 4)
															 status = 'Waiting for acceptance';
														 
														 if (S > 2)
														 H += '<div class="pull-left wdth100"><span id="more' + Z + '" onclick="showContainer(' + Z +')" class="detailIconB text-center">&nbsp;</span><span class="fnt12 text-right wdth100 bold mrgnbtm20_0 sts">Order Status: ' + status + '</span></div>';
													     else
														 H += '<div class="pull-left wdth100"><span style="width:50%;float:left" id="" onclick="" class="">&nbsp;</span><span class="fnt12 text-right wdth100 bold mrgnbtm20_0 sts">Order Status: ' + status + '</span></div>';	 
														 
														 H +=  '</div>';
														 
														 I = I + 1;	
														 
														 Z = Z + 1;
														 
														 if (I % 2 == 0)
														  {
															  H += '</div>';
															  G = 0;
														  }	
												});
														if (I % 2 != 0)
														   {
															   H  += '</div>';
														   }
															   $("#priority").html(H);
											}
									else
												{
														 $("#priority").html("Sorry! No Order Found.");
												}
														 staffPerformance(P.staff);
					        }
					  });
					  
				}
			
		function showContainer(data)
			{
				   // $("#morediv"+ data + " .fdItem" ).css("display", "block");
				   // $("#more"+data).css('display','none');
				   
				   // $("#morediv"+ data + " .fdItem" ).css("display", "block");
				   // $("#more"+data).css('display','none');
				   
				   
				  var F =  $("#morediv"+ data + " #menuList").attr('data-attr');
				   
				  if (F == 0)
					  {
						   $("#morediv"+ data + " .fdItem" ).css("display", "block");
				          // $("#more"+data).css('display','none');
						  
						  $("#morediv"+ data + " #menuList").attr('data-attr', 1);
						  
						  $("#more"+ data).removeClass('detailIconB').addClass('detailIconU');
						  
						  
					  }
				  else
					  {
						   $("#morediv"+ data + " #menuList .fdItem").slice(2).hide();
						   $("#morediv"+ data + " #menuList").attr('data-attr', 0);
						   
						   $("#more"+ data).addClass('detailIconB').removeClass('detailIconU');
					  }
			   }
			   
			   
			   
		function showContainerData(data)
			{
				  $("#cancelBox"+ data).css("display", "block"); 
				  
				  var F =  $("#cancelBox"+ data + " #menuList").attr('data-attr');
				   
				  if (F == 0)
					  {
						   $("#cancelBox"+ data + " .cfdItem" ).css("display", "block");
				          // $("#more"+data).css('display','none');
						  
						  $("#cancelBox"+ data + " #menuList").attr('data-attr', 1);
						  
						  $("#cancelToggle"+ data).removeClass('detailIconB').addClass('detailIconU');
						  
						  
					  }
				  else
					  {
						   $("#cancelBox"+ data + " #menuList .cfdItem").slice(2).hide();
						   $("#cancelBox"+ data + " #menuList").attr('data-attr', 0);
						   
						   $("#cancelToggle"+ data).addClass('detailIconB').removeClass('detailIconU');
					  }
			   }
					



					
						
		$("#newTab").click(function() {
			
			  $("#newBadge").removeClass('badgecount').html('');
			
			  $.ajax({
					       url: "<?php echo base_url(); ?>index.php/order/newOrderBadge",
						   type:"GET",
						   dataType:"json",
						   async: false,
						   success:function(P) 
						      {
								  
							  }
			        });
			 
			 
		});
		
		
		$("#pendingTab").click(function() {
			
			  $("#pendingBadge").removeClass('badgecount').html('');
			
			  $.ajax({
					       url: "<?php echo base_url(); ?>index.php/order/pendingBadge",
						   type:"GET",
						   dataType:"json",
						   async: false,
						   success:function(P) 
						      {
							  }
			        });
			 
			 
		});
		
		
		$(".black_overlay").click(function() {
			
			$('#fade').css('display','none');
			$('.popUp').attr('style','');
			$('.cnclBx').css('display','none');
			
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
				$("#cancelBox" + id).css("display","block");
				// $("#orderCancelReason").css("display","block");
				
			}
						
    </script>
	
	
</body>


</html>
			