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
#slide {
	border:1.5px solid black;
	position:absolute;
	top:0;
	left:0;
	width:150px;
	height:100%;
	background-color:#F2F2F2;
	layer-background-color:#F2F2F2;
}
</style>
</head>
<body>

    <div id="wrapper">
       <?php $this->load->view('include/inc_navigation'); ?>
      <div id="page-wrapper" class="gray-bg sidebar-content">
	  
       <div class="row border-bottom">
	   <?php $this->load->view('include/inc_topnav'); ?>
       </div>
	   
	     <div id="toggle" style="display:none;position:absolute;right:230px;top:60px;text-align:right"><a href="javascript:void(0);" style="cursor:pointer"><strong>Hide</strong></a></div>
		 
		 <span id="notfiyCount" style="cursor:pointer" class="badge badge-info pull-right"></span>
		 
		 
	     <div class="sidebard-panel" style="display:none">
                <?php $this->load->view('include/inc_sidebar'); ?>
         </div>
		
        <div class="wrapper wrapper-content" id="leftWrapper" style="padding-right:0">
            <div class="row">
                 <!-- Table -->
				     <div class="col-lg-12" id="mainContainer">
						<div class="ibox float-e-margins">	
							<div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">View Negligent Marking</div>
							  <div class="ibox-content">
								<?php echo validation_errors(); ?>
								<?php echo form_open('negligent/filterNegligent', array('class' => 'form-horizontal')); ?>
							    	<div class="row" style="margin-bottom:20px">
												<div class="col-md-12">

												   <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
														<input type="text" name="start_date" class="form-control" placeholder="Start Date" id="start_date4" value="<?php echo set_value('start_date'); ?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												   </div>
												  
												   <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
													<input type="text" name="end_date" class="form-control" value="<?php echo set_value('end_date'); ?>" placeholder="End Date" id="end_date4"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												   </div>
									
								  
												  <div class="col-md-3 text-left" style="float:left;margin-right:10px">
													 <input type="submit" class="btn btn-primary" value="Filter" />
												  </div>   
												   
											     </div>
										
									
								    <!-- <div class="form-group control-label">
									    <label class="col-sm-2 control-label">Start Date</label>
										<div class="input-group date">
											  <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date" class="form-control" value="<?php echo (set_value('start_date') != '') ? set_value('start_date') : date('m/d/Y'); ?>">
										</div>					
									</div>
									
									
									
									<div class="form-group control-label"><label class="col-sm-2 control-label">End Date</label>
										<div class="input-group date">
											  <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="end_date" class="form-control" value="<?php echo (set_value('end_date') != '') ? set_value('end_date') : date('m/d/Y'); ?>" />
										</div>					
									</div>
									
									<div class="form-group control-label">
									    <label class="col-sm-2 control-label"><button class="btn btn-primary" type="submit">Filter</button></label>				
									</div>-->
									
								</div>
								
								<?php echo form_close(); ?>
								   
									<div class="hr-line-dashed"></div>
								   

									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover <?php echo count($negligent) ? 'dataTables-example' : "";?>">
											<thead>
												<tr>
													<th>S No</th>
													<th>Order #</th>
													<th>Time & Date</th>
													<th>Customer Name</th>
													<th>Email Id</th>
													<th>Service Employee</th>
													<th>Reason for Cancellation</th>
												</tr>
											</thead>
											<tbody>
											
											<?php
											   if (count($negligent) > 0)
												   {
													   $i = 0;
													   foreach ($negligent as $data)
														   {   
															   $i++;
															   echo '<tr class="">
																		<td>'.$i.'</td>
																		<td>'.$data->order_id.'</td>
																		<td>'.date('h:i A, M d Y', $data->order_time).'</td>
																		<td>'.ucwords($data->name).'</td>
																		<td>'.$data->email.'</td>
																		<td>'.getStaffMemberName($data->staff_member_id).'</td>
																		<td>'.$data->message.'</td>
																	 </tr>';
														   }
												   }
											   else
													   {
														   echo '<tr class="">
																	<td colspan=\'7\'>No Negligent Marking.</td>
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
	
	<script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                ]
            });
			
			var date = new Date();
			$('.input-group.date').datepicker({
					todayBtn: "linked",
					keyboardNavigation: false,
					forceParse: false,
					calendarWeeks: true,
					autoclose: true,
					endDate:0
			});
				
				
        });
		
		
		var width = $('#slide').width() - 10;
		$('#slide').hover(function () {
			 $(this).stop().animate({left:"0px"},500);     
		   },function () {          
			 $(this).stop().animate({left: - width  },500);     
		});
		
		
    </script>
	
</body>

</html>
			