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
</head>
<body>

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
								
								<div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">VIEW LOCATIONS</div>
								
								<div class="ibox-content">
									  <div class="row">
										 <div class="col-md-4"></div>
										 <div class="col-md-4">

											 <?php 
                                              if (isset($locations['cinema']))
												  {
													  $audi_id = $this->input->get('audi');
													  echo '<select class="form-control m-b" name="branch" onchange="audiLocation(this.value)">';
													  echo "<option value=\"\">-- Select Location --</option>";
													  foreach ($locations['cinema'] as $cinema_location)
														  {
															  $selected = ($audi_id == $cinema_location->id) ? "selected='selected'" : "";
															  echo "<option $selected value=\"$cinema_location->id\">".$cinema_location->audi_id."</option>";
														  }
													  echo '</select>';
												  }
												  
											  if (isset($locations['restaurants']))
												  {
													  $rest_id = $this->input->get('rest');
													  echo '<select class="form-control m-b" name="branch" onchange="restLocation(this.value)">';
													  echo "<option value=\"\">-- Select Floor --</option>";
													  foreach ($locations['restaurants'] as $rest_location)
														  {
															  $selected = ($rest_id == $rest_location->id) ? "selected='selected'" : "";
															  echo "<option $selected value=\"$rest_location->id\">".$rest_location->floor_id."</option>";
														  }
													  echo '</select>';
												  }														  
											?>

											 
										</div>
											   
										<div class="col-md-4"></div>		   
									  </div>

									  
									<?php
                                       if (isset($cinema_data))
										   {
											   foreach ($cinema_data as $cin_data)
												   {
 													  $i = 0;   
													  echo '<div class="table-responsive">
																<h2>'.$cin_data['row_name'].'</h2>';
																foreach ($cin_data['seats'] as $seat_data)
																	{
																		$i++;
																		echo '<table class="table table-striped table-bordered table-hover dataTables-example" >
																				<thead>
																					<tr>
																						<th>S No</th>
																						<th>Seats No Id</th>
																					</tr>
																				</thead>
																				<tbody>
																					 <tr>
																						<td>'.$i.'</td>
																						<td>'.$seat_data->seats_no.'</td>
																					 </tr>
																				
																				</tbody>
																        </table>';	
																	}
																	
														       echo '</div>';
												   }
										   }
									 ?>
									 
									 <?php
                                       if (isset($rest_data))
										   {
											   $i = 0;
											  echo  '<div class="table-responsive">
														<table class="table table-striped table-bordered table-hover dataTables-example" >
															<thead>
																<tr>
																	<th>S No</th>
																	<th>Seats No</th>
																	<th>Type</th>
																</tr>
															</thead>
															<tbody>';
											   foreach ($rest_data as $rest_info)
												   {
														  $i++;   
														  echo '<tr>
																		<td>'.$i.'</td>
																		<td>'.$rest_info->location_name.'</td>
																		<td>'.(($rest_info->form == 1) ? "Standee" : "Sticker").'</td>
																</tr>';	
													}
												echo '</tbody>
																</table>
															</div>';
										   }
									 ?>
									 
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
	
</body>

<script>

     $(document).ready(function() {
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: []
            });
    });
		
	function audiLocation(value)
		{
			location.href = "<?php echo base_url(); ?>index.php/admin/location?audi=" + value;
		}
		
		
		
	function restLocation(value)
		{
			location.href = "<?php echo base_url(); ?>index.php/admin/location?rest=" + value;
		}

</script>

</html>
			