<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo config_item('admin_page_title'); ?>Login</title>
    <link href="<?php echo config_item('base_url'); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo config_item('base_url'); ?>assets/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo config_item('base_url'); ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo config_item('base_url'); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo config_item('base_url'); ?>assets/css/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=places"></script>
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
						   if ($estab_flag > 0)
						     {
						         echo '<div style=\'font-size:14px;line-height:48px;margin:5px 0 20px 0\' class=\'btn-primary btn-xs\'><i class="fa fa-check"></i> You already add a establishment.!</div>';
						     }
					       else
						     {
					    ?>

							<div class="ibox-title">
								<h5>Add Establishment</h5>
								<div class="ibox-tools">
									<a class="collapse-link">
										<i class="fa fa-chevron-up"></i>
									</a>
								</div>
							</div>
						
							<div class="ibox-content">
								<?php echo validation_errors(); ?>
								
								<?php echo form_open('', array('class' => 'form-horizontal')); ?>
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
									
									<div class="form-group">
										<div class="col-sm-12 text-center heght30">
										   <label class="col-sm-4 control-label">Name</label><div class="col-sm-6"><input class="form-control crsntalwd" type="text" readonly="readonly" id="name" name="name" /></div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-sm-12 text-center heght30">
										   <label class="col-sm-4 control-label">Address</label><div class="col-sm-6"><input class="form-control crsntalwd" type="text" readonly="readonly" name="address" id="address" /></div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-sm-12 text-center heght30">
										   <label class="col-sm-4 control-label">Contact Number</label><div class="col-sm-6"><input class="form-control crsntalwd" type="text" readonly="readonly" id="contact_number" name="contact_number" /></div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-sm-12 text-center">
										   <label class="col-sm-4 control-label">Opening Hours</label><div class="col-sm-6"><textarea class="form-control crsntalwd" id="opening_hours" name="opening_hours" readonly="readonly"></textarea></div>
										</div>
									</div>
									
									<input type="hidden" name="latlng" id="latlng" value="" readonly="readonly" />
									

									<div class="form-group"><label class="col-sm-4 control-label">Primary Contact Name</label>
										<div class="col-sm-6"><input type="text" name="primary_contact_name" class="form-control" placeholder="Primary Contact Name"></div>
									</div>
									
									<div class="hr-line-dashed"></div>
									<div class="form-group"><label class="col-sm-4 control-label">Owner</label>
										<div class="col-sm-6"><input type="text" name="owner" class="form-control" placeholder="Owner"></div>
									</div>
									
									
									<div class="hr-line-dashed"></div>
									<div class="form-group"><label class="col-sm-4 control-label">Primary Phone No</label>
										<div class="col-sm-6"><input type="text" name="primary_phone_no" class="form-control" placeholder="Primary Phone No"></div>
									</div>
									
									
									<div class="hr-line-dashed"></div>
									<div class="form-group"><label class="col-sm-4 control-label">Primary Email</label>
										<div class="col-sm-6"><input type="text" name="primary_email" class="form-control" placeholder="Primary Email"></div>
									</div>
									
									
									<div class="hr-line-dashed"></div>
									<div class="form-group"><label class="col-sm-4 control-label">Outlet timings</label>
										<div class="col-sm-6"><input type="text" name="outlet_timings" class="form-control" placeholder="Outlet timings"></div>
									</div>
									
									<div class="hr-line-dashed"></div>
									
							
									<div class="form-group"><label class="col-sm-4 control-label">Secondary Contact Name</label>
										<div class="col-sm-6"><input type="text" name="secondary_contact_name" class="form-control" placeholder="Secondary Phone No (Optional)"></div>
									</div>
									<div class="hr-line-dashed"></div>
									
									
									
									 <div class="form-group"><label class="col-sm-4 control-label">Designation</label>
										<div class="col-sm-6"><input type="text" name="designation" class="form-control" placeholder="Designation (Optional)"></div>
									</div>
									<div class="hr-line-dashed"></div>
									
									
									<div class="form-group"><label class="col-sm-4 control-label">Secondary Phone no</label>
										<div class="col-sm-6"><input type="text" name="secondary_phone_no" class="form-control" placeholder="Secondary Phone No (Optional)"></div>
									</div>
									<div class="hr-line-dashed"></div>
									
									
									<div class="form-group"><label class="col-sm-4 control-label">Secondary Email</label>
										<div class="col-sm-6"><input type="text" name="secondary_email" class="form-control" placeholder="Secondary Email (Optional)"></div>
									</div>
									<div class="hr-line-dashed"></div>
									
									
									<div class="hr-line-dashed"></div>
									<div class="form-group"><label class="col-sm-4 control-label">Facebook</label>
										<div class="col-sm-6"><input type="text" name="fb_link" class="form-control" placeholder="Facebook Link (Optional)"></div>
									</div>
									
									<div class="hr-line-dashed"></div>
									<div class="form-group"><label class="col-sm-4 control-label">Twitter</label>
										<div class="col-sm-6"><input type="text" name="twitter_link" class="form-control" placeholder="Twitter Link (Optional)"></div>
									</div>
									
									<div class="hr-line-dashed"></div>
									<div class="form-group"><label class="col-sm-4 control-label">LinkedIn</label>
										<div class="col-sm-6"><input type="text" name="linkedin_link" class="form-control" placeholder="LinkedIn Link (Optional)"></div>
									</div>
									
									<div class="hr-line-dashed"></div>
									<div class="form-group"><label class="col-sm-4 control-label">Youtube</label>
										<div class="col-sm-6"><input type="text" name="youtube_link" class="form-control" placeholder="Youtube Link (Optional)"></div>
									</div>
									
									<div class="hr-line-dashed"></div>
									<div class="form-group"><label class="col-sm-4 control-label">Instagram</label>
										<div class="col-sm-6"><input type="text" name="instagram_link" class="form-control" placeholder="Instagram Link (Optional)"></div>
									</div>
									
									<div class="hr-line-dashed"></div>
									<div class="form-group"><label class="col-sm-4 control-label">Website</label>
										<div class="col-sm-6"><input type="text" name="web_link" class="form-control" placeholder="Website Link (Optional)"></div>
									</div>
									
									<div class="hr-line-dashed"></div>
									<div class="form-group"><label class="col-sm-4 control-label">Other Details</label>
										<div class="col-sm-6"><input type="text" name="other_details" class="form-control" placeholder="Other Details (Optional)"></div>
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
	
</body>
</html>

<script>



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
  var defaultBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(28.6139, 77.2090),
      new google.maps.LatLng(28.6139, 77.2090));
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
	  $("#contact_number").val(formatted_phone_number);
	  $("#opening_hours").html(opening_hours);
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
