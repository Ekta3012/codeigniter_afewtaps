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
</style>
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
							
							  <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;margin-bottom:20px">Service App User</div>
							
						
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

								<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
										<thead>
										<tr>
											<th>S No</th>
											<th>Employee ID</th>
											<th>Establishment Name</th>
										
											<th>Address</th>
											<th>Service Employee Name</th>
											<th>Email ID</th>
											<th>Mobile No.</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
									
										<?php
								
								   if (count($service['services']) > 0)
									   {
										   $i = 0;
										   //print_r($service['services']);
										   foreach ($service['services'] as $data)
											   {
												   
											
												   $i++;
											
											
												  
												   echo '<tr class="">
												            <td>'.$i.'</td>
															
															<td>'.$data->{'employee_id'}.'</td>
															<td>'.$data->{'estabname'}.'</td>
																<td>'.$data->{'address'}.'</td>
																<td>'.$data->{'name'}.'</td>
																<td>'.$data->{'email_id'}.'</td>
															<td class="center">'.($data->{'contact_no'} != '' ? $data->{'contact_no'} : '-------------------------').'</td>
															
															<td class="text-center"><a style="  border-right: 1px solid #ccc;
    padding-right: 7px;" title="Edit" href="'.base_url().'index.php/establishment/suseredit/'.$data->{'sid'}.'/'.$this->uri->segment(3).'"><img src="'.config_item('base_url').'assets/img/edit.png"></a>&nbsp;&nbsp;<a  title="Delete" href="'.base_url().'index.php/establishment/delete/'.$data->{'sid'}.'/'.$this->uri->segment(3).'" onclick="return confirm(\'Are you sure! You want to Delete this entries ?\')"><img src="'.config_item('base_url').'assets/img/delete.png"></a></td>
															
														 </tr>';
											
									   }
									   }
								   else
									   {
										           echo '<tr class="">
												            <td colspan=\'12\'>No Data.</td>
												           
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
  <!--  <script src="<?php echo config_item('base_url'); ?>assets/js/switchery.js"></script>-->

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
	
		
    </script>
	<script>
		function branchStaff(value)
			{
				location.href = "<?php echo base_url(); ?>index.php/establishment/service/" + value;
			}
    </script>
	
</body>

</html>
			