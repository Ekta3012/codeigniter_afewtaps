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
<link href="<?php echo config_item('base_url'); ?>assets/css/datepicker.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/awesome-bootstrap-checkbox.css" rel="stylesheet">
</head>
<style>
ul {margin:0;padding:0}
ul li {margin-left:2px;list-style-type:none;line-height:30px}


</style>

<body>

    <div id="wrapper">
       <?php $this->load->view('include/inc_navigation'); ?>
      <div id="page-wrapper" class="gray-bg">
       <div class="row border-bottom">
	     <?php $this->load->view('include/inc_topnav'); ?>
       </div>

	     <div id="toggle" style="display:none;position:absolute;right:230px;top:60px;text-align:right"><a href="javascript:void(0);" style="cursor:pointer"><strong>Hide</strong></a></div>
		 
		 <span id="notfiyCount" style="cursor:pointer" class="badge badge-info pull-right"></span>
		 
		 
	     <div class="sidebard-panel" style="display:none">
                <?php $this->load->view('include/inc_sidebar'); ?>
         </div>

        <div class="wrapper wrapper-content" id="leftWrapper" style="padding-right:0">
		
		   <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Last Order Notification</div>
								
            <div class="row">
                 <!-- Table -->
				 
				        <div class="col-lg-12" style="padding:0">
							<div class="ibox float-e-margins">

								<div class="ibox-content">
								
								  <?php echo validation_errors(); ?>
							      <?php echo form_open('payment/lastordernotification'); ?>
							   
							       <?php echo ($this->session->flashdata('updt')) ? '<div style=\'line-height:28px;margin:5px 0 20px 0\' class=\'btn-primary btn-xs\'><i class="fa fa-check"></i> Updated successfully.</div>' : ''; ?>
								   
								   
									<ul style="margin:0;padding:0">
									
									  <?php
									    $fselected =  (isset($info->flag)) ? (($info->flag == 1) ? "checked='checked'" : "") : "";
										$cselected =  (isset($info->flag)) ? (($info->flag == 0) ? "checked='checked'" : "") : "";									
									  ?>
									  
									  <li><input <?php echo $fselected; ?> type="radio" name="method" value="1" id="radio1" />&nbsp;Yes<br />
									  
									  <p>Notifications shall be pushed for orders placed
									         <select name="notification_before_hr" class="form-control" style="width:5%;display:inline">
											   <?php
											    $selected = '';
											    for ($i = 1; $i <= 25; $i++)
													{
														 $selected =  (isset($info->notifiy_hr_last_order)) ? (($info->notifiy_hr_last_order == $i) ? "selected='selected'" : "") : "";
														 echo "<option  $selected value=\"$i\">$i</option>";
													}
											   
										       ?>
											 </select>
											 
									  hours before last order timings</p>
									 </li>
									 
									  <li><input <?php echo $cselected; ?> type="radio" name="method" value="0" id="radio1" />&nbsp;No</li>
									  
									</ul><br />
									
									<div class="form-group" style="height:45px">
                                        <div class="col-sm-2" style="padding:0">Last Order Timing</div>
                                        <div class="col-sm-8" style="padding:0">
										
										<?php
											    $ohr  =  '';
												$omin =  '';
												if (isset($info->last_order_timing))
													{
														list($ohr, $omin) = explode(':', $info->last_order_timing);
													}
										?>
										
										  Hr&nbsp;<select name="last_order_hr" class="form-control" style="width:10%;display:inline">
										      
		                                       <?php
											    for ($i = 1; $i <= 23; $i++)
													{
														$selected = ($ohr == $i) ? "selected='selected'" : "";
														echo "<option $selected value=\"$i\">$i</option>";
													}
											    
										       ?>
										  </select>
										  
										  &nbsp;&nbsp;&nbsp;Min &nbsp;<select name="last_order_min" class="form-control" style="width:10%;display:inline">
										      <?php
											    for ($i = 1; $i <= 59; $i++)
													{
														$selected = ($omin == $i) ? "selected='selected'" : "";
														echo "<option $selected value=\"$i\">".str_pad($i, 2, 0, STR_PAD_LEFT)."</option>";
													}
											    
										       ?>
										  </select>
										  
										  
										</div>
                                    </div>
									
									
									<div style="width:50%;text-align:center;margin-top:10px"><button type="submit" class="btn btn-primary">Submit</button></div>
									
									<?php echo form_close(); ?>
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
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/datepicker.js"></script>
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/datatables.min.js"></script>
	
	<script>
        $(document).ready(function(){
			
			$('#date_added').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#date_modified').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
			
			
			
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'TaxFile'},
                    {extend: 'pdf', title: 'TaxFile'},

                    {extend: 'print',
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
	
</body>

</html>
			