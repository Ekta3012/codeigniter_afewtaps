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
<link href="<?php echo config_item('base_url'); ?>assets/css/switchery.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/datatables.min.css" rel="stylesheet">
<style>
.switchery{background-color:#ed5565 !important }
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
								<div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">View Establishments</div>
								  <div class="ibox-content">
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover dataTables-example" >
											<thead>
													<tr>
														<th>S No</th>
														<th>Establishment Name</th>
														<th>Address</th>
														<th>Primary Contact Name</th>
														<th>EmailId</th>
														<th>Action</th>
													</tr>
											</thead>
											<tbody>
											
												<?php
												   if (count($establishment) > 0)
													   {
														   $i = 0;
														   foreach ($establishment as $data)
															   {
																   $i++;
																   echo '<tr class="">
																			<td>'.$i.'</td>
																			<td>'.$data->{'name'}.'</td>
																			<td>'.$data->{'address'}.'</td>
																			<td class="center">'.($data->{'primary_contact_name'} != '' ? $data->{'primary_contact_name'} : 'N/A').'</td>
																			<td class="center">'.($data->{'primary_email'} != '' ? $data->{'primary_email'} : 'N/A').'</td>
																			<td class="center"><a href="'.base_url().'index.php/establishment/index/'.$data->{'id'}.'/'.$this->uri->segment(3).'"><button class="btn btn-primary"><i class="fa fa-edit"></i> </button></a>
																			</td>
																		 </tr>';
															   }
													   }
												   else
													   {
																   echo '<tr class="">
																			<td colspan=\'4\'>No Establishment.</td>
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

	
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/switchery.js"></script>
	
	<script>
        $(document).ready(function(){
			
			var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });			
			
			setInterval(function(){ timerOnOff() }, 1000);

        });
		

		function timerOnOff()
			{
				var date     =  new Date();
				var hours    =  parseInt(date.getHours());
				var minute   =  parseInt(date.getMinutes());
			
			    if ((hours == 9) && minute == 45)
					{
						alert("pls on timer");
						return false;
					}
		
				if ((hours == 6 || hours == 18) && minute == 0)
					{
						alert("pls off timer");
						return false;
					}
		
			}
    </script>
	
</body>

</html>
			