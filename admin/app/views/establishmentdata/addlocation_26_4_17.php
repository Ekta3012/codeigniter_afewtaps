a<!DOCTYPE html>
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
<link href="<?php echo config_item('base_url'); ?>assets/css/chosen.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/select2.min.css" rel="stylesheet">
<style>
.row.text-center {
    background-color: rgb(199, 199, 199);
    border-radius: 14px;
	 margin-bottom: 20px;
}
.rows.text-center {
   
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
.row.text-center .nonactive{color:#000}
.rows.text-center .nonactive {
    background: #404040 none repeat scroll 0 0;
    color: #fff;  margin-bottom: 0 !important;
}
.rows.text-center .active {
background: rgb(199, 199, 199) none repeat scroll 0 0;
box-shadow: none !important;
color: #000;

    
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


.switchery{background-color:#ed5565 !important }
.addMore{background:url(<?php echo base_url(); ?>assets/img/more.png); background-repeat:no-repeat;padding:0 10px;margin:8px 0 8px 5px;float:left;text-align:center;cursor:pointer}
.addRemove{background:url(<?php echo base_url(); ?>assets/img/minus.png); background-repeat:no-repeat;padding:0 10px;margin:8px 0 8px 5px;float:left;text-align:center;cursor:pointer}
.xgs{border:1px solid #ccc;height:min-height:300px;padding:30px;margin:5px 0}
.wdt60{width:60%}
.xvp{border:1px solid #CCC;margin:20px 0 20px 30px}
.mrgn{margin:10px 0 0 30px;padding:10px}
.mrgncgb{margin:10px 0 10px 90px;padding:10px}
.mrgntpbt{margin:10px 0}
.btn-w-m{min-width:0}


</style>
</head>
<body>

    <div id="wrapper">
       <?php $this->load->view('include/inc_navigation'); ?>
      <div id="page-wrapper" class="gray-bg sidebar-content">
       <div class="row border-bottom">
	   <?php $this->load->view('include/inc_topnav'); ?>
       </div>
	   
	    <div class="sidebard-panel">
                <?php $this->load->view('include/inc_sidebar'); ?>
        </div>
		
        <div class="wrapper wrapper-content" id="leftWrapper">
            <div class="row">
                 <!-- Table -->
				     <div class="col-lg-12">
							<div class="ibox float-e-margins">	
							  <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Establishment Data</div>
								
							    <?php echo form_open('establishmentdata/location'); ?>
							  
								<div class="ibox-content">
								  <div class="row"></div>
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
											case 'menu':
											            $menuitem    = 'active';
														break;
														
											case 'location':
											            $locationitem    = 'active';
														break;
											
											case 'merchant':
											            $merchantinfor    = 'active';
														break;
														
										 }
								  ?>
								  <div class="row text-center">
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/order"><button class="btn <?php echo isset($orderitem) ? $orderitem : "nonactive" ; ?>" data-attr="order" type="button">Order History</button></a>
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside"><button class="btn <?php echo isset($insideitem) ? $insideitem : "nonactive" ; ?>" data-attr="inside" type="button">Inside Information</button></a>
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/analytics"><button class="btn <?php echo isset($analyticsitem) ? $analyticsitem : "nonactive" ; ?>" data-attr="analytics" type="button">Analytics</button></a>
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/ratings"><button class="btn <?php echo isset($ratingsitem) ? $ratingsitem : "nonactive" ; ?>" data-attr="ratings" type="button">Ratings</button></a>
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/menu"><button class="btn <?php echo isset($menuitem) ? $menuitem : "nonactive" ; ?>" data-attr="menu/1" type="button">Menu Items</button></a>
									 <a href="<?php echo base_url(); ?>index.php/establishmentdata/location"><button class="btn <?php echo isset($locationitem) ? $locationitem : "nonactive" ; ?>" data-attr="menu/1" type="button">Location</button></a>         
								     <a href="<?php echo base_url(); ?>index.php/establishmentdata/merchant"><button class="btn <?php echo isset($merchantinfor) ? $merchantinfor : "nonactive" ; ?>" data-attr="merchant" type="button">Merchant Information</button></a>
								  </div>
								  
								  <br>
								  
								    <div class="row">
                                       <div class="col-md-12 text-right">
										  <a href="<?php echo base_url(); ?>index.php/establishmentdata/viewLocation/<?php echo $this->uri->segment(3); ?>"><strong>View Location</strong></a>
                                       </div>
						            </div>	
								
								  <?php echo validation_errors(); ?>
								
                                  <div class="row">
                                    <div class="col-md-12">
										<?php 
											$branches = getAllBranches();
											
											if (count($branches) > 0)
											  {
												 echo '<select class="form-control m-b" name="estabid" onchange="pageload(this.value)">';
												 echo '<option value="">Select Establishment</option>';
												 foreach ($branches as $bdata)
												   {
													   $checkinfo = (int) $this->db->select('info')->get_where($this->db->dbprefix('payment_method'), array('branch_id' => $bdata->id))->row()->info;
													   if ($checkinfo == 0)
														   {
															    $selected = ($this->uri->segment(3) == $bdata->id) ? "selected='selected'" : "";
																echo "<option $selected value='".$bdata->{'id'}."'>".$bdata->{'name'}."</option>";
														   }
												   }
													   echo '</select>';
											  }
										?>
                                      </div>
						            </div>
								   
								    
									<div class="row"><br /></div>
											 
									<div class="row">
									   <div class="col-lg-4"></div>
									   <div class="col-lg-2 radio radio-info radio-inline control-label"><input name="type" type="radio" class="form-control" checked="checked" value="1" id="cinemaRadio" /><label for="SelfOwned">Cinema</label></div>
									   <div class="col-lg-2 radio radio-info radio-inline control-label"><input type="radio"  class="form-control" name="type" value="2" id="restRadio" /><label for="SelfOwned">Restaurant</label></div>
									   <div class="col-lg-4"></div>
									</div>
											 
									<br />
										 
									 <div class="row" id="cinemaContainer">
										<!-- <div class="row">
										   <div class="col-lg-2"></div>
										   <div class="col-lg-6"><input type="text" name="cinema_name" class="form-control" placeholder="Cinema Name" /></div>
										   <div class="col-lg-4"></div>
										</div> -->
										
										
										
										<br />
											<div class="row">
											  <div class="col-lg-1"></div>
												<div class="col-lg-10 text-center xgs" id="audiCont">
												
													<div class="row mrgntpbt">
														<!-- <input type="text" name="audi" class="pull-left form-control wdt60" placeholder="Audi Name" autocomplete="off">-->
														
														<select tabindex="-1" style="width:350px;display:none;" class="audiData form-control" data-placeholder="Enter New Audi Or Choose a Audi..." name="audi">
													   
															 <option value=""></option>
															 <?php
															  if (count($audis) > 0)
																   {
																	  foreach ($audis as $audis_data)
																	  echo "<option value=\"id_$audis_data->id\">".$audis_data->audi_id."</option>";
																   }
															 ?>
														</select>
										
										
													</div>
													
													<div class="row xvp" id="rowd">
													
													   <!-- <div class="row mrgn"> 
														 <input type="text" name="audi[0][row_no][0][no]" class="pull-left form-control wdt60"  placeholder="Enter Row No." />
														 <span data-start='0' data-end='1' class="addMore" id="rowAddContainer">&nbsp;</span>
														 <span class="addRemove" id="rowRemContainer">&nbsp;</span>
													   </div> -->
													   
													   <div class="row mrgn"> 
														 <input type="text" name="rowno" class="pull-left form-control wdt60"  placeholder="Enter Row No." />
													   </div>
													   

													   <div class="row mrgncgb"> 
														<input type="text" name="audi_seats[]" class="pull-left form-control wdt60" placeholder="Enter Seat No" autocomplete="off" />
														
														<span class="addMore" data-start='0' data-end='1' id="seatAddContainer">&nbsp;</span>
														<span class="addRemove" id="seatRemContainer">&nbsp;</span>
														
													   </div>
													   
													</div>	
													
												
													
											   </div>
											   <div class="col-lg-1"></div>
											</div>
									</div>
										 
									<div class="" id="floorContainer" style="display:none">
										<div class="row" style="margin:5px 0">
											<div class="col-lg-3">
												<select name="rest[0][floor_id]" class="form-control">
												   <option value="">-- Select Floor --</option>
												   <option value="LG">LG</option>
												   <option value="UG">UG</option>
												   <option value="G">G</option>
												   <option value="FF">FF</option>
												   <option value="SF">SF</option>
												   <option value="TF">TF</option>
												   <option value="TR">Terrace</option>
												</select>
											</div>
											
											<div class="col-lg-3">
											   <input type="text" name="rest[0][location_name]" class="form-control" placeholder="Add Table No./Location" />
											</div>
											
											<!--div class="col-lg-4">
											   <select name="rest[0][form]" class="form-control">
												   <option>-- Select Form --</option>
												   <option value="1">Standee</option>
												   <option value="2">Sticker</option>
												   <option value="3">Flag</option>
												</select>
											</div-->
											<input type="hidden" name="rest[0][form]" value="" />
											<div class="col-lg-2">
											   <span class="addMore" id="addFloor">&nbsp;</span>
											   <span class="addRemove" id="removeFloor">&nbsp;</span>
											</div>
										</div>
									 </div>
											 
									 <div class="col-lg-12 text-center">
										<button class="btn btn-primary text-right" type="submit">Submit</button>
									 </div>
				
									 <div class="col-lg-12 text-center" style="margin:10px 0"></div>
									 <input type="hidden" id="audiCount" name="audiCount" value="1" />
									 <input type="hidden" id="floorCount" name="floorCount" value="1" />
                                
								</div>
								
								
								<?php echo form_close(); ?>
								
								
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
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/chosen.jquery.js"></script>
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/select2.full.min.js"></script>
    	<script>
		
		
	var width = $('#slide').width() - 10;
		$('#slide').hover(function () {
			 $(this).stop().animate({left:"0px"},500);     
		   },function () {          
			 $(this).stop().animate({left: - width  },500);     
		});

		
		function showContainer(id)
			{
				$('div.slides ul li').removeClass('liactive');
				$('#cuisine_'+id).addClass('liactive');
				
				$('.menucontainer').css('display', 'none');
				$('#menucontainer' + id).css('display', 'block');
			var subid = id;
			//alert(subid);
				
				
			}

	</script>
	<script>
		 
		 $("#addFloor").on('click', function() {
		 
		 var count = parseInt($("#floorCount").attr('value'));
		 var H = '';
		 
		 H += '<div class="row" style="margin:5px 0"><div class="col-lg-3"><select name="rest[' + count + '][floor_id]" class="form-control"><option value="">-- Select Floor --</option><option value="LG">LG</option><option value="UG">UG</option><option value="G">G</option><option value="FF">FF</option><option value="SF">SF</option><option value="TF">TF</option><option>ADD FLOOR</option></select></div><div class="col-lg-3"><input type="text" name="rest[' + count + '][location_name]" class="form-control" placeholder="Add Table No./Location" /></div><input type="hidden" name="rest[' + count + '][form]" value="" /><!--div class="col-lg-4"><select name="rest[' + count + '][form]" class="form-control"><option>-- Select Form --</option><option value="1">Standee</option><option value="2">Sticker</option><option value="3">Flag</option></select></div--><div class="col-lg-2"></div></div>';
		 
		 $("#floorContainer").append(H);
		 
		 
		 count++;
		 
		 $("#floorCount").attr('value', count);
		 
	 });
	 
	 
	 $("#removeFloor").on('click', function() {
		  
		  $("div #floorContainer").children().not(':first').last().remove();
		  
		  var count = parseInt($("#floorCount").attr('value'));
		  count--;
		  $("#floorCount").attr('value', count);
		  
		 
	 });
	 
	 
	 $("#cinemaRadio").on('click', function() {
		  
		  $("#cinemaContainer").css('display', 'block');
		  $("#floorContainer").css('display', 'none');
		  
		 
	 });
	 
	 $("#restRadio").on('click', function() {
		  
		  $("#cinemaContainer").css('display', 'none');
		  $("#floorContainer").css('display', 'block');
		  
		 
	 });
	 
	 
	// $("#audiAddContainer").on('click', function() {
		 
	 $("body").on("click", "#audiAddContainer", function() {
		 var H = '';
		  
		 var C = parseInt($("#audiCount").attr('value'));
		 H += '<div class="row"><div class="col-lg-1"></div><div class="col-lg-10 text-center xgs"><div class="row mrgntpbt"><input type="text" placeholder="Audi Name" class="pull-left form-control text-center wdt60" name="audi[' + C + '][name]"><span id="audiAddContainer" class="addMore">&nbsp;</span><span id="audiRemContainer" class="addRemove">&nbsp;</span></div><div class="row xvp"><div class="row mrgn"><input type="text" data-start=' + start + ' data-end=' + end + ' placeholder="Enter Row No." class="pull-left form-control wdt60" name="audi[' + C + '][row_no][0][no]"><span id="rowAddContainer" class="addMore">&nbsp;</span><span id="rowRemContainer" class="addRemove">&nbsp;</span></div><div class="row mrgncgb"><input type="text" placeholder="Enter Seat No" class="pull-left form-control wdt60" name="audi[' + C + '][row_no][0][seat_no][]"><span id="seatAddContainer" class="addMore" data-start=' + C + '>&nbsp;</span><span id="seatRemContainer" class="addRemove">&nbsp;</span></div></div></div><div class="col-lg-1"></div></div>';
		
		 C++;
		 $("#audiCount").attr('value', C);
		 
													
		 $("#cinemaContainer").append(H);											
													
		 
	 });
	 
	 
	 $("body").on("click", "#rowAddContainer", function() {
      
		  var start   =  parseInt($("#audiCount").attr('value')); //$(this).attr('data-start');
		  //var end     =  $(this).attr('data-end');
		
		
		  var P       = '';
		  
		  P += '<div class="row xvp"><div class="row mrgn"><input type="text" placeholder="Enter Row No." class="pull-left form-control wdt60" name="audi['  + start + '][row_no]['  + start + '][no]"></div><div class="row mrgncgb"><input type="text" placeholder="Enter Seat No" class="pull-left form-control wdt60" name="audi['  + start + '][row_no]['  + start + '][seat_no][]"><span data-start=' + start + ' id="seatAddContainer" class="addMore">&nbsp;</span><span id="seatRemContainer" class="addRemove">&nbsp;</span></div></div>';
		  

		  start++;
		  
		  $("#audiCount").attr('value', start);
		  
		  //$(this).attr('data-end', end);
			  
		  $("#audiCont").append(P);
															
    });

	
	$("body").on("click", "#seatAddContainer", function() {
      
	  var start   =  $(this).attr('data-start');
	  var P = '';
	  P += '<div class="row mrgncgb"><input type="text" placeholder="Enter Seat No" class="pull-left form-control wdt60" name="audi_seats[]"></div>';
	 
	  $(this).parent().after(P);
	  
															
    });
	
	
	
	$(document).ready(function () {
				
		
				var config = {
								'.chosen-select'           : {},
								'.chosen-select-deselect'  : {allow_single_deselect:true},
								'.chosen-select-no-single' : {disable_search_threshold:10},
								'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
								'.chosen-select-width'     : {width:"95%"}
							 }
							 
				for (var selector in config) {
					$(selector).chosen(config[selector]);
				}
		
        });
		
	$(".audiData").select2({
				tags: "false",
				placeholder: "Enter Or Choose a Audi...",
				allowClear: true
			});
			
	function pageload(id) {
		
		location.href = "<?php echo base_url(); ?>index.php/establishmentdata/location/" + id;
	}
	
    </script>
</body>

</html>
			