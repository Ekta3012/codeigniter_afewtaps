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
	<link href="<?php echo config_item('base_url'); ?>assets/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo config_item('base_url'); ?>assets/css/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyARvn51JQhFTzlmSpOBEElMyUWcRvCy-uQ"></script>
    <script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/tags/markerwithlabel/1.1.9/src/markerwithlabel.js"></script>
	<style>
	.controls {
        margin-top: 16px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }
  
      #pac-input {
        background-color: #fff;
        padding: 0 11px 0 13px;
        width: 400px;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        text-overflow: ellipsis;
      }

      #pac-input:focus {
        border-color: #4d90fe;
        margin-left: -1px;
        padding-left: 14px;  /* Regular padding-left + 1. */
        width: 401px;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
	  .heght30{height:30px}
	  .crsntalwd{cursor:not-allowed}
	  
	  ul{margin:0;padding:0}
	  ul li{line-height:26px;list-style-type:none;text-align:left;margin-bottom:10px}
	  .form-control1{border:1px solid #e5e6e7;padding:3px;}

</style>
</head>

<body class="fixed-navigation">
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
                 <!-- Form -->
				 <div class="row">
				   <div class="col-lg-12">
                    <div class="ibox float-e-margins">
  
						<?php
						   //if ($estab_flag > 0)
							if ($estab_flag > 0)
						     {
						         echo '<div style=\'font-size:14px;line-height:48px;margin:5px 0 20px 0\' class=\'btn-primary btn-xs\'><i class="fa fa-check"></i> You already add a establishment.!</div>';
						     }
					       else
						     {
					    ?>

							<div class="ibox-title" style="background-color:#2f4050;color:#FFF">
								<h5>Establishment</h5>
								<div class="ibox-tools">
									<a class="collapse-link">
										<i class="fa fa-chevron-up"></i>
									</a>
								</div>
							</div>
						
							<div class="ibox-content">
								<?php echo validation_errors(); ?>
								
								<?php echo form_open_multipart('', array('class' => 'form-horizontal')); ?>
									<div class="form-group">
										<input id="pac-input" class="controls" type="text" placeholder="Search Establishment">
										<div id="map-canvas" style="width:100%;height:350px"></div>
									</div>
								
									<!--<div class="form-group">
										<div class="col-sm-12 text-center">
											<div class="radio radio-info radio-inline control-label">
												<input type="radio" checked="" name="owner" value="1" id="SelfOwned">
												<label for="SelfOwned">Self Owned</label>
											</div>
											
											<div class="radio radio-info radio-inline control-label">
												<input type="radio" name="owner" value="2" id="FranchiseeRadio">
												<label for="FranchiseeRadio">Franchisee</label>
											</div>
										</div>
									</div>-->
									
									
									
								<div class="form-group" style="<?php echo isset($estab_info->logo) ? "height:90px" : "" ; ?>">
								    <div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">Logo</label>
									   
									   <div class="col-sm-6 text-left">
									   
									   <?php 
											if (isset($estab_info->logo))
											echo "<img src='".base_url()."../uploads/".$estab_info->logo."' alt='' width='80' />";
									   ?>
									   
									   <input class="form-control" type="file" id="logo" name="logo" style="border:none;padding:0" /></div>
									</div>
								</div>
								
								
								<div class="form-group"  style="<?php echo isset($estab_info->cover_image) ? "height:90px;margin-bottom:30px" : "" ; ?>">
								    <div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">Cover Image</label>
									   
									   <div class="col-sm-6 text-left">
									   <?php 
											if (isset($estab_info->cover_image))
											echo "<img src='".base_url()."../uploads/".$estab_info->cover_image."' alt='' width='80' />";
									   ?>
									   <input class="form-control" type="file" id="cover_image" name="cover_image" style="border:none;padding:0" /></div>
									</div>
								</div>
								

								<div class="form-group">
									<div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">Name</label><div class="col-sm-6"><input class="form-control" type="text"  id="name" name="name" placeholder="Name (required)" value="<?php echo isset($estab_info->name) ? $estab_info->name : "" ?>" /></div>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">Address</label><div class="col-sm-6"><input class="form-control crsntalwd" type="text" readonly="readonly" placeholder="Address (required)" name="address" id="address" value="<?php echo isset($estab_info->address) ? $estab_info->address : "" ?>" /></div>
									</div>
								</div>
								
								
								<div class="form-group">
								    <div class="col-sm-12 text-center heght30">
								        <label class="col-sm-4 control-label">Locality</label>
										<div class="col-sm-4 text-center">
										   <select tabindex="-1" style="width:350px;display:none;" class="localityData form-control" data-placeholder="Enter New Locality Or Choose a Locality..." name="locality">
											 <?php
											  if (count($locality) > 0)
												   {
													  foreach ($locality as $locality_data)
														  {
															  $selected = (isset($estab_info->city) ? (($estab_info->city == $locality_data->city) ? "selected='selected'" : "") : "");
															  echo "<option value='$locality_data->city'>".$locality_data->city."</option>";
														  }
												   }
											 ?>
											</select>
											
										</div>
									</div>
                                </div>
								
								
								
								<div class="form-group">
									<div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">Contact Number</label><div class="col-sm-6"><input class="form-control crsntalwd" type="text" id="contact_number" name="contact_number" value="<?php echo isset($estab_info->phoneno) ? $estab_info->phoneno : "" ?>"  placeholder="Contact Number (required)" /></div>
									</div>
								</div>
								
								<div class="form-group" style="height:200px">
									<div class="col-sm-12 text-center">
									   <label class="col-sm-4 control-label">Opening Hours</label><div class="col-sm-8">
									   
									   <!-- <textarea class="form-control crsntalwd" id="opening_hours" name="opening_hours" readonly="readonly"></textarea> -->
									   
									   <?php
									   
										   $arr = array('mon','tue','wed','thu','fri','sat','sun');
										   
										   echo '<div class="col-sm-12" style="margin:10px 0;height:30px">
										             <div class="col-sm-4">
													     <strong>Days</strong>
													 </div>
													 <div class="col-sm-4">
														 <strong>Opening HH:MM</strong>
													 </div>
													 <div class="col-sm-4">	 
														 <strong>Closing HH:MM</strong>
													 </div>
												 </div>';
										   
										   foreach ($arr as $k => $arr_data)
											{
												$key = $k + 1;
												
												$open_time_hr   = '';
												$open_time_min  = '';
												
												$close_time_hr  = '';
												$close_time_min = '';
												
												$checked 		= '';
												$hstyle   		= '';
												$mstyle   		= '';
												
												if (isset($estab_info->$arr_data) && ! empty($estab_info->$arr_data))
													{
														$time_decode 						    =   json_decode($estab_info->$arr_data);
														list($open_time_hr, $open_time_min)     =   explode (':', $time_decode->otime);
														list($close_time_hr, $close_time_min)   =   explode (':', $time_decode->ctime);
													}
												elseif (isset($estab_info->$arr_data) && empty($estab_info->$arr_data))
													{
														$checked  = "checked";
														$hstyle   = "style='display:none'";
														$mstyle   = "style='display:none;padding-left:30px'";
													}
												else
													{
														$checked  = "";
														$hstyle   = "";
														$mstyle   = "";
													}
												
													
												$ohr_option = '';
											    for($i = 0; $i <= 24; $i++)
												   {
													  $selected = ($open_time_hr == $i) ? "selected='selected'" : "";
													  $ohr_option .= "<option $selected value='$i'>".str_pad($i, 2, 0, STR_PAD_LEFT)."</option>";
												   }
											   
											   
											    $omin_option = '';
											    for ($i = 0; $i < 60; $i++)
												   {
													  $selected = ($open_time_min == $i) ? "selected='selected'" : "";
													  $omin_option .= "<option $selected value='$i'>".str_pad($i, 2, 0, STR_PAD_LEFT)."</option>";
												   }
								 
												   
												$chr_option = '';
											    for ($i = 0; $i <= 24; $i++)
												   {
													   $selected = ($close_time_hr == $i) ? "selected='selected'" : "";
													   $chr_option .= "<option $selected value='$i'>".str_pad($i, 2, 0, STR_PAD_LEFT)."</option>";
												   }
											   
												$cmin_option = '';
											    for ($i = 0; $i < 60; $i++)
												   {
													   $selected = ($close_time_min == $i) ? "selected='selected'" : "";
													   $cmin_option .= "<option $selected value='$i'>".str_pad($i, 2, 0, STR_PAD_LEFT)."</option>";
												   }
										   
												
												$hr  = "<select class='form-control1' name='ohr_$key'>";
												$hr .= $ohr_option;
												$hr .= '</select>';
												
												$min  = "<select class='form-control1' name='omin_$key'>";
												$min .= $omin_option;
												$min .= '</select>';
												
												$chr  = "<select class='form-control1' name='chr_$key'>";
												$chr .= $chr_option;
												$chr .= '</select>';
												
												$cmin  = "<select class='form-control1' name='cmin_$key'>";
												$cmin .= $cmin_option;
												$cmin .= '</select>';
												
												echo '<div class="col-sm-12" style="margin:5px 0;height:30px">
												        <div class="col-sm-2" style="padding:0 2px"><span>'.ucwords($arr_data).'</span></div>
														<div class="col-sm-2" style="padding:0 2px"><input type=\'checkbox\' '.$checked.' name=\'open_'.$key.'\' value=\'1\' id=\'closed\' data-attr='.$key.' />&nbsp;<span>Closed</span></div>
														
														<div class="col-sm-4" style="padding:0 2px"><span '.$hstyle.' id="otime_'.$key.'">'.$hr.'&nbsp;'.$min.'</span></div>
														<div class="col-sm-4" style="padding:0 2px"><span '.$mstyle.' id="ctime_'.$key.'">'.$chr.'&nbsp;'.$cmin.'</span></div>
													</div>';
											}
									  ?>	 
					
									   
									   </div>
									</div>
								</div>
								
								<input type="hidden" name="latlng" id="latlng" value="" readonly="readonly" />
								

								<div class="form-group"><label class="col-sm-4 control-label">Primary Contact Name</label>
									<div class="col-sm-6"><input type="text" name="primary_contact_name" class="form-control" placeholder="Primary Contact Name (required)" value="<?php echo isset($estab_info->primary_contact_name) ? $estab_info->primary_contact_name : "" ?>"></div>
								</div>
								
								<!-- <div class="hr-line-dashed"></div>
								<div class="form-group"><label class="col-sm-4 control-label">Owner</label>
									<div class="col-sm-6"><input type="text" name="owner" class="form-control" placeholder="Owner"></div>
								</div> -->
								
								
								<div class="hr-line-dashed"></div>
								<div class="form-group"><label class="col-sm-4 control-label">Primary Phone No</label>
									<div class="col-sm-6"><input type="text" name="primary_phone_no" class="form-control" placeholder="Primary Phone No (Optional)" value="<?php echo isset($estab_info->primary_phone_no) ? $estab_info->primary_phone_no : "" ?>" /></div>
								</div>
								
								
								<div class="hr-line-dashed"></div>
								<div class="form-group"><label class="col-sm-4 control-label">Primary Email</label>
									<div class="col-sm-6"><input type="text" name="primary_email" class="form-control" placeholder="Primary Email (Optional)" value="<?php echo isset($estab_info->primary_email) ? $estab_info->primary_email : "" ?>" /></div>
								</div>
								
								
								<div class="hr-line-dashed"></div>
								
								<!--<div class="form-group"><label class="col-sm-4 control-label">Outlet timings</label>
									<div class="col-sm-6"><input type="text" name="outlet_timings" class="form-control" placeholder="Outlet timings"></div>
								</div>
								
								<div class="hr-line-dashed"></div>-->
								
						
								<div class="form-group"><label class="col-sm-4 control-label">Secondary Contact Name</label>
									<div class="col-sm-6"><input type="text" name="secondary_contact_name" class="form-control" placeholder="Secondary Phone No (Optional)" value="<?php echo isset($estab_info->secondary_contact_name) ? $estab_info->secondary_contact_name : "" ?>" /></div>
								</div>
								<div class="hr-line-dashed"></div>
					
								
								 <div class="form-group"><label class="col-sm-4 control-label">Designation</label>
									<div class="col-sm-6"><input type="text" name="designation" class="form-control" placeholder="Designation (Optional)"value="<?php echo isset($estab_info->designation) ? $estab_info->designation : "" ?>" /></div>
								</div>
								<div class="hr-line-dashed"></div>
								
								
								<div class="form-group"><label class="col-sm-4 control-label">Secondary Phone no</label>
									<div class="col-sm-6"><input type="text" name="secondary_phone_no" class="form-control" placeholder="Secondary Phone No (Optional)" value="<?php echo isset($estab_info->secondary_phone_no) ? $estab_info->secondary_phone_no : "" ?>" /></div>
								</div>
								<div class="hr-line-dashed"></div>
								
								
								<div class="form-group"><label class="col-sm-4 control-label">Secondary Email</label>
									<div class="col-sm-6"><input type="text" name="secondary_email" class="form-control" placeholder="Secondary Email (Optional)" value="<?php echo isset($estab_info->secondary_email) ? $estab_info->secondary_email : "" ?>" /></div>
								</div>
								<div class="hr-line-dashed"></div>
								
								
								<div class="hr-line-dashed"></div>
								<div class="form-group"><label class="col-sm-4 control-label">Facebook</label>
									<div class="col-sm-6"><input type="text" name="fb_link" class="form-control" placeholder="Facebook Link (Optional)"value="<?php echo isset($estab_info->fb_link) ? $estab_info->fb_link : "" ?>" /></div>
								</div>
								
								<div class="hr-line-dashed"></div>
								<div class="form-group"><label class="col-sm-4 control-label">Twitter</label>
									<div class="col-sm-6"><input type="text" name="twitter_link" class="form-control" placeholder="Twitter Link (Optional)" value="<?php echo isset($estab_info->twitter_link) ? $estab_info->twitter_link : "" ?>" /></div>
								</div>
								
								<div class="hr-line-dashed"></div>
								<div class="form-group"><label class="col-sm-4 control-label">LinkedIn</label>
									<div class="col-sm-6"><input type="text" name="linkedin_link" class="form-control" placeholder="LinkedIn Link (Optional)" value="<?php echo isset($estab_info->linkedin_link) ? $estab_info->linkedin_link : "" ?>" /></div>
								</div>
								
								<div class="hr-line-dashed"></div>
								<div class="form-group"><label class="col-sm-4 control-label">Youtube</label>
									<div class="col-sm-6"><input type="text" name="youtube_link" class="form-control" placeholder="Youtube Link (Optional)" value="<?php echo isset($estab_info->youtube_link) ? $estab_info->youtube_link : "" ?>" /></div>
								</div>
								
								<div class="hr-line-dashed"></div>
								<div class="form-group"><label class="col-sm-4 control-label">Instagram</label>
									<div class="col-sm-6"><input type="text" name="instagram_link" class="form-control" placeholder="Instagram Link (Optional)" value="<?php echo isset($estab_info->instagram_link) ? $estab_info->instagram_link : "" ?>" /></div>
								</div>
								
								<div class="hr-line-dashed"></div>
								<div class="form-group"><label class="col-sm-4 control-label">Website</label>
									<div class="col-sm-6"><input type="text" name="web_link" class="form-control" placeholder="Website Link (Optional)"value="<?php echo isset($estab_info->web_link) ? $estab_info->web_link : "" ?>" /></div>
								</div>
								
								<div class="hr-line-dashed"></div>
								<div class="form-group"><label class="col-sm-4 control-label">Other Details</label>
									<div class="col-sm-6"><input type="text" name="other_details" class="form-control" placeholder="Other Details (Optional)" value="<?php echo isset($estab_info->other_details) ? $estab_info->other_details : "" ?>" /></div>
								</div>
								

							   <!-- <div class="form-group"><label class="col-sm-4 control-label">Secondary Contact Name</label>
									<div class="col-sm-6"><input type="text" class="form-control" placeholder="Secondary Contact Name"></div>
								</div>
								
								<div class="hr-line-dashed"></div>
								<div class="form-group"><label class="col-sm-4 control-label">Manager</label>
									<div class="col-sm-6"><input type="text" class="form-control" placeholder="Manager"></div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group"><label class="col-sm-4 control-label">Secondary Phone No</label>

									<div class="col-sm-6"><input type="text" name="text" class="form-control" placeholder="Secondary Phone No"></div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group"><label class="col-sm-4 control-label">Secondary Email</label>

									<div class="col-sm-6"><input type="text" class="form-control" placeholder="Secondary Email"></div>
								</div>
								<div class="hr-line-dashed"></div> -->
								

								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-2"> 
										<button type="submit" class="btn btn-primary">Save changes</button>
										<button type="reset" class="btn btn-white">Cancel</button>
									</div>
								</div>
									
								<?php echo form_close(); ?>
								
							</div>
						
						<?php } ?>
						
                    </div>
                 </div>
				</div>
				 <!-- Close -->
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
	<script src="<?php echo config_item('base_url'); ?>assets/js/select2.full.min.js"></script>
	
</body>
</html>

<script>

$(".localityData").select2({
				tags: "false",
				placeholder: "Enter Or Choose a Locality...",
				allowClear: true
			});
			
			
$('#contact_number').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 45 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
});



//$("#closed").on('click', function() {
$("body").on("click", "#closed", function(event){
	
	var data = $(this).attr('data-attr');

	if ( ! $(this).is(":checked")) {
	
	    $("#otime_" + data).css('display', 'inline-block');
	    $("#ctime_" + data).css('display', 'inline-block');
	}
	else
  	  {
		$("#otime_" + data).css('display', 'none');
		$("#ctime_" + data).css('display', 'none');
	 }
});


// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.

function initialize() {

  var markers = [];
  var map = new google.maps.Map(document.getElementById('map-canvas'), {
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  
 // var infowindow = new google.maps.InfoWindow();
  var service = new google.maps.places.PlacesService(map);

  
  
if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = new google.maps.LatLng(position.coords.latitude,
                                       position.coords.longitude);

      var infowindow = new google.maps.InfoWindow({
        map: map,
        position: pos,
        content: 'Here you are.'
      });

      map.setCenter(pos);
    });
  }
  
    <?php 
       if (isset($estab_info->lat) && isset($estab_info->lng))
		   {
			   $lat = $estab_info->lat;
			   $lng = $estab_info->lng;
		   }  
	   else
		   {
			   $lat = '28.6139';
			   $lng = '77.2090';
		   }
	 
	?>
	
  var defaultBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng('<?php echo $lat; ?>', '<?php echo $lng; ?>'),
      new google.maps.LatLng('<?php echo $lat; ?>', '<?php echo $lng; ?>'));
  map.fitBounds(defaultBounds);

  // Create the search box and link it to the UI element.
  var input = /** @type {HTMLInputElement} */(
      document.getElementById('pac-input'));
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  var searchBox = new google.maps.places.SearchBox(
    /** @type {HTMLInputElement} */(input));

  // [START region_getplaces]
  // Listen for the event fired when the user selects an item from the
  // pick list. Retrieve the matching places for that item.
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }

    // For each place, get the icon, place name, and location.
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };
      
      /* alert */
	  
	  
	  var request =  {
          reference: place.reference
    };
      service.getDetails(request, function(place, status) {

      var open = null;
      try {
                  //open = place.opening_hours.periods[1].open.time;
                  open = place.opening_hours.weekday_text;
          }
      catch(e)
	    {
                  open = 'No work time';
        }

      console.log(place);

	  var name                   = place.name;
	  
	  var formatted_address      = '';
	  if (typeof place.formatted_address != "undefined") {
		  formatted_address      = place.formatted_address;
	  }
	  
	  var formatted_phone_number = '';
	  if (typeof place.formatted_phone_number != "undefined") {
		  formatted_phone_number = place.formatted_phone_number;
	  }
		  
	  var latlng   =   '';
	  if (typeof place.geometry.location != "undefined") {
		  latlng                 = place.geometry.location;
	  }
	  
	  var opening_hours = '';
	  
	  if (typeof place.opening_hours != "undefined") {
		  opening_hours          = place.opening_hours.weekday_text;
		  
	  }
	  
	  $("#name").val(name);
	  $("#address").val(formatted_address);
	  //$("#contact_number").val(formatted_phone_number);
	  //$("#opening_hours").html(opening_hours);
	  $("#latlng").val(latlng);
	  
	  /* close */
      
      // Create a marker for each place.
     var marker = new MarkerWithLabel({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location,
       labelContent: "",
       labelClass: "labels", // the CSS class for the label
       labelStyle: {opacity: 0.75},
              labelAnchor: new google.maps.Point(12, 0)
      });
	  
	 });

      markers.push(marker);

      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);
  });
  // [END region_getplaces]

  // Bias the SearchBox results towards places that are within the bounds of the
  // current map's viewport.
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
