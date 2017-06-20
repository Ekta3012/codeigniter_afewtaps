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
				     <div class="col-lg-12">
					  <div class="ibox float-e-margins">
					  
					  
						<div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">View Tax</div>
						
						<div class="ibox-content" style="min-height:0">

						       <?php echo form_error('service_charge'); ?>
							   
							   <?php echo ($this->session->flashdata('updtsc')) ? '<div style=\'line-height:28px;margin:5px 0 20px 0\' class=\'btn-primary btn-xs\'><i class="fa fa-check"></i> Service Charge updated successfully.</div>' : ''; ?>
							
							   <?php echo form_open('tax/serviceCharge', array('class' => 'form-horizontal')); ?>
							
							    <div class="row">
								
								    <div class="col-sm-2" style="line-height:34px;font-weight:bold">Service Charge</div>
								
									<div class="col-sm-2"><input type="text" placeholder="" name="service_charge" class="form-control" value="<?php echo $serviceCharge; ?>" autocomplete="off" /></div>
									
									
									<div class="col-sm-1">
                                        <button type="submit" class="btn btn-primary text-right">Submit</button>
                                    </div>
									
									<?php
									  if (isset($serviceCharge))
										  {
											  echo '<div class="col-sm-1"><img src="'.base_url().'assets/img/checked_arrow.png" alt="" style="margin:10px 0 0 0" /></div>';
										  }
									?>
									
									
									
								</div>
								
								<?php echo form_close(); ?>
								
						</div>		
						
						
						  <div class="ibox-content">

							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<th>S No</th>
									<th>Name</th>
									<th>Rate</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								
								<?php
								   if (count($tax) > 0)
									   {
										   $i = 0;
										   foreach ($tax as $data)
											   {
												   $i++;
												   switch ($data->tax_index)
													   {
														    case 1:
														                $apply_for = 'VAT (Alchoholic & Aerated Drinks)';
																		break;
															case 2:
																	    $apply_for = 'Service Tax (Bill Total + Service Charge)';
																		break;
																		
															case 3:
															            $apply_for = 'VAT (Food & Drinks)';
																		break;
													   }
													   
												   echo '<tr class="">
												            <td>'.$i.'</td>
															<td>'.$apply_for.'</td>
															<td>'.$data->{'tax_rate'}.' %</td>
															<td class="center"><a href="'.base_url().'index.php/tax/index/'.$data->{'id'}.'"><button class="btn btn-primary"><i class="fa fa-edit"></i> </button></a>&nbsp;&nbsp;<a href="'.base_url().'index.php/tax/del/'.$data->{'id'}.'" onclick="return confirm(\'Are you sure ?\')"><button class="btn btn-danger"><i class="fa fa-trash"></i> </button></a></td>
														 </tr>';
											   }
									   }
								   else
										   {
													   echo '<tr class="">
																<td colspan=\'5\'>No Data.</td>
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
	
	<script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: []
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
			