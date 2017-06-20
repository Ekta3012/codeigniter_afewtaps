<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo config_item('admin_page_title'); ?>Front End User</title>
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
							
							  <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;margin-bottom:20px">Service App User</div>
							
						
								<div class="ibox-content">
                                <?php 
                              
?>
  <div class="row text-center">
   <?php echo form_open('', array('class' => 'form-horizontal')); ?>
									
									    <div class="col-lg-2">						
						                </div>
										  
									      <div class="col-lg-3">
											<select name="establish" class="form-control m-b">
											    <option value="">Establishment Name</option>
                                           <?php  foreach ($service['estab'] as $data)
											   {
													?> <option value="<?php if($data->{'main'}=='1'){ echo $data->{'branch_id'}; } ?>"><?php if($data->{'main'}=='1'){ echo $data->{'estabname'}; } ?></option>
                                                    
                                                   
														<?php	
															}
															
											   ?>
											</select>							
						                  </div>
										
										  <div class="col-lg-2">
											 <button type="submit" class="btn" style="background:#2A3F54;color:#FFF;border-radius:8px">Submit</button>					
						                  </div>
										   <?php echo form_close(); ?>   
									</div>
                                    
                                    <?php 
											  ?>

								<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
										<thead>
										<tr>
											<th>S No</th>
											<th>Employee Id</th>
											<th>Establishment Name</th>
											<th>Branch</th>
											<th>Address</th>
											<th>Service Employee Name</th>
											<th>Email Id</th>
											<th>Mobile No.</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
									
										<?php
										//print_r($service['services']);
										//print_r($service['estabid']);
										//print_r($estab);
										 //print_r($service['estabidd']);
								   if (count($service['services']) > 0)
									   {
										   $i = 0;
										   //print_r($service['services']);
										   foreach ($service['services'] as $data)
											   {
												   
											
												   $i++;
											
												   if($data->{'main'}=='1')
												   {
													  $branchname = "--";
													  
												   }
												   else
												   {
													   $branchname = $data->{'estabname'};
												   }
												   
												
												  
												   echo '<tr class="">
												            <td>'.$i.'</td>
															
															<td>'.$data->{'employee_id'}.'</td>';
															if(count($service['estabid'])>0)
															{
															foreach ($service['estabid'] as $estabid)
															{
																foreach ($estabid as $est)
															{
													?> <td> <?php 	if($data->{'main'}=='0') { echo $est->{'name'}; } else { echo $data->{'estabname'}; } ?></td>
														<?php	}
															}
															}
															else
															{
																?> <td> <?php 	if($data->{'main'}=='0') { echo $est->{'name'}; } else { echo $data->{'estabname'}; } ?></td>
														<?php
															}
															
														
														echo 	'<td>'.$branchname.'</td>
															
															
															<td>'.$data->{'estabadress'}.'</td>
																<td>'.$data->{'name'}.'</td>
																<td>'.$data->{'email_id'}.'</td>
															<td class="center">'.($data->{'contact_no'} != '' ? $data->{'contact_no'} : '-------------------------').'</td>
															
															<td class="text-center"><a href="'.base_url().'index.php/establishment/suseredit/'.$data->{'id'}.'"><button class="btn btn-primary"><i class="fa fa-edit"></i> </button></a>&nbsp;&nbsp;<a href="'.base_url().'index.php/establishment/delete/'.$data->{'id'}.'" onclick="return confirm(\'Are you sure ?\')"><button class="btn btn-danger"><i class="fa fa-trash"></i> </button></a></td>
															
														 </tr>';
											
									   }
									   }
								   else
									   {
										           echo '<tr class="">
												            <td colspan=\'6\'>No Data.</td>
												            <td><input type="checkbox" class="js-switch" checked /></td>
												            <td><button class="btn btn-primary"><i class="fa fa-edit"></i> </button> <button class="btn btn-danger"><i class="fa fa-trash"></i> </button></td>
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
                dom: '<"html5buttons"B>lTfgitp',
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
			