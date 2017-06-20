<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo config_item('admin_page_title'); ?></title>
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
							
							  <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;margin-bottom:20px">Front End User</div>
						       
								<div class="ibox-content">
									<div class="row">
										<div class="col-md-3">
											<select class="form-control m-b" id="locality">
										        <option value="">-- Select Locality --</option>
											        <?php
													  if (is_array($location) && count($location) > 0)
  												      foreach ($location as $loc_val)
												      echo "<option value=\"$loc_val->id\">$loc_val->locality</option>";
													?>
											</select>
									    </div>
										
										<div class="col-sm-3 text-center">
									          <button type="button" class="btn btn-primary" onclick="filterdata()">Submit</button>
                                        </div>   
										   
									</div>
								</div>
								
								
								<div class="ibox-content" id="filterDataTable">

								 <div class="table-responsive">
							     	 <table class="table table-striped table-bordered table-hover dataTables-example" >
										<thead>
											<tr>
												<th>S No</th>
												<th>User Name</th>
												<th>Locality</th>
												
												<th>Email Id</th>
												<th>Mobile No.</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
									
										<?php
											   if (count($front) > 0)
												   {
													   $i = 0;
													   foreach ($front as $data)
														   {
															   $i++;

															   echo '<tr class="">
																		<td>'.$i.'</td>
																		
																		<td>'.$data->{'name'}.'</td>
																		
																		<td>'.getUserLocality($data->id).'</td>
																		
																			<td>'.$data->{'email'}.'</td>
																		<td class="center">'.($data->{'contactno'} != '' ? $data->{'contactno'} : '-------------------------').'</td>
																		
																		<td class="text-center"><a style="  border-right: 1px solid #ccc;
				padding-right: 7px;" title="Edit" href="'.base_url().'index.php/establishment/fuseredit/'.$data->{'id'}.'"><img src="'.config_item('base_url').'assets/img/edit.png"></a>&nbsp;&nbsp;<a title="Delete" href="'.base_url().'index.php/establishment/del/'.$data->{'id'}.'" onclick="return confirm(\'Are you sure! You want to Delete this entries ?\')"><img src="'.config_item('base_url').'assets/img/delete.png"></a></td>
																		
																	 </tr>';
														   }
												   }
											   else
												   {
															   echo '<tr class="">
																		<td colspan=\'6\'>No Data.</td>
																	  
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
				
				"pagingType": "full_numbers",
				'iDisplayLength': 10,
             
                buttons: [
                   {
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });
			$('.dataTables_filter input[type="search"]').attr('placeholder','Search by any field');
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


    </script>
	<script>
		function branchStaff(value)
			{
				location.href = "<?php echo base_url(); ?>index.php/establishment/service/" + value;
			}
			
		function filterdata() {
			
			var locality_id = $("#locality").val();
			$.ajax({
						url: '<?php echo base_url(); ?>index.php/establishment/frontDataUser',
						type: "GET",
						dataType: "json",
						data: {'locality_id':locality_id, '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
						success: function (L) 
							 {
								   var H = '';
								   H += '<div class="table-responsive"><table class="table table-striped table-bordered table-hover dataTables-example" ><thead><tr><th>S No</th><th>User Name</th><th>Locality</th><th>Email Id</th><th>Mobile No.</th><th>Action</th></tr></thead><tbody>';
								 
								  if (parseInt(L.result.length) > 0)
									  {
										    var i = 0;
										    var base_url =  "<?php echo base_url(); ?>";
										  
										    $.each(L.result, function(A,B) {
										    
										    var locality =  ""
											  
											i = i + 1;
											
											H += '<tr class=""><td>' + i + '</td><td>' + B.name + '</td><td>' + B.locality + '</td><td>' + B.email + '</td><td class="center">'+  B.contactno + '</td><td class="text-center"><a style="border-right: 1px solid #ccc;padding-right: 7px;" title="Edit" href="' + base_url + 'index.php/establishment/fuseredit/' + B.id + '"><img src="' + base_url + 'assets/img/edit.png"></a>&nbsp;&nbsp;<a title="Delete" href="' + base_url + 'index.php/establishment/del/' 
											+ B.id +'" onclick="return confirm(\'Are you sure! You want to Delete this entries ?\')"><img src="' + base_url +'assets/img/delete.png"></a></td></tr>';
											
											H += '</tbody></table>';
											
											$("#filterDataTable").html(H);
											
											$('.dataTables-example').DataTable({
				
													"pagingType": "full_numbers",
													'iDisplayLength': 10,
												 
													buttons: [
													   {
														 customize: function (win){
																$(win.document.body).addClass('white-bg');
																$(win.document.body).css('font-size', '10px');

																$(win.document.body).find('table')
																		.addClass('compact')
																		.css('font-size', 'inherit');
														}
														}
													]

												});
			
											$('.dataTables_filter input[type="search"]').attr('placeholder','Search by any field');
			
										  })
									  }
									   else
										   {
													   H += '<tr class=""><td colspan=\'6\'>No Data.</td></tr>';
													   H += '</tbody></table>';
													   $("#filterDataTable").html(H);
										   }
													
													   
													   
													   
													   
													   
													   
		
		
							 }
				 });
		}
    </script>
	
</body>

</html>
			