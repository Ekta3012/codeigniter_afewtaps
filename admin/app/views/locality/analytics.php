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
<link href="<?php echo config_item('base_url'); ?>assets/css/datatables.min.css" rel="stylesheet">
	<style>
	.row.text-center {
    background-color: rgb(199, 199, 199);
    border-radius: 14px;
	 margin-bottom: 20px;
}
.row.text-center .active {
    background-color: rgb(42, 63, 84);
    border-radius: 7px;
    box-shadow: none !important;
    color: #fff;
    margin-top: 5px;
}
.nonactive{color:#000}
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

.slides {
    width: 65%;
    overflow: auto;
	margin-top:20px
}
.slides ul {
    display: inline-block;
    height: 28px;
    white-space: nowrap;
}
.slides ul li {
    height: 100%;
    width: auto;
    display: inline-block;
    /*float: left;*/
    margin: 2px;
	margin:5px 10px;
	text-align:center;
	cursor:pointer
}

.vg{background:url('../../../assets/img/red_icon.png');background-repeat:no-repeat;width:20px;height:20px;float:left;background-position:center center}
.nonvg{background:url('../../../assets/img/green_icon.png');background-repeat:no-repeat;width:20px;height:20px;float:left;background-position:center center}


.addMenu{background:#2A3F54;color:#FFF}
.btn:focus, .btn:hover{color:#FFF}
.liactive {border-bottom:2px solid #404040;cursor:not-allowed !important}
.form-group{margin-top:5px !important; margin-bottom:5px !important}
.col-sm-12{margin-top:3px !important}
ul {margin:0;padding:0}
ul li {margin-left:20px;list-style-type:none;line-height:26px}
.col-sm-6{font-weight:normal}
.btn-circle {
  width: 15px;
  height: 15px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.42;
  border-radius: 15px;
}

.lclr{color:#676a6c !important;font-weight:bold}
.lactive{color:#676a6c !important;font-weight:bold}
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
							 <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Locality Information</div>
								<div class="ibox-content">
                                 <div class="row">
                                  <div class="col-md-4"></div>
                                     <div class="col-md-4">
										 <?php 
												$branches = getEstabLocation();
												
												if (count($branches) > 0)
												  {
													 echo '<select class="form-control m-b" name="branch" onchange="branchStaff(this.value)">';
													 echo '<option value="">Select Location</option>';
													 foreach ($branches as $bdata)
													   {
														
														   $selected = (urldecode($this->uri->segment('3')) == $bdata->{'city'}) ? "selected='selected'" : "" ;
														   echo "<option $selected value='".$bdata->{'city'}."'>".$bdata->{'city'}."</option>";
													   }
														   echo '</select>';
												  }
											?>
                                          </div>
                                           
										<div class="col-md-4"></div>		   
								</div>
								  
                                <?php
								     $segment =  $this->uri->segment(2);
									 switch ($segment)
										 {
											
											case 'list':
											            $list    = 'active';
														break;
											case 'summary':
											            $summary    = 'active';
														break;			
											case 'order':
											            $order    = 'active';
														break;
											case 'analytics':
											            $analytics    = 'active';
														break;
											
											case 'insideinfo':
											            $insideinfo    = 'active';
														break;
														
										 }
								  ?>
                                
								        <div class="row text-center">
                                             <a href="<?php echo base_url(); ?>index.php/locality/lists/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($list) ? $list : "nonactive" ; ?>" data-attr="list" type="button">List of Restaurant</button></a>
                                              <a href="<?php echo base_url(); ?>index.php/locality/summary/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($summary) ? $summary : "nonactive" ; ?>" data-attr="summary" type="button">Summary</button></a>
                                              <a href="<?php echo base_url(); ?>index.php/locality/order/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($order) ? $order : "nonactive" ; ?>" data-attr="order" type="button">Order History</button></a>
                                                <a href="<?php echo base_url(); ?>index.php/locality/analytics/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($analytics) ? $analytics : "nonactive" ; ?>" data-attr="analytics" type="button">Analytics</button></a>
                                               <a href="<?php echo base_url(); ?>index.php/locality/insideinfo/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($insideinfo) ? $insideinfo : "nonactive" ; ?>" data-attr="insideinfo" type="button">Inside Information</button></a>
								        </div>
										
										
										
										
										
                                          
                                          <!--prev and current month-->
										  
							  <?php
								 $lmactive = ($this->uri->segment(5) == 1 || $this->uri->segment(5) == '') ? 'lclr' : '';
								 $nmactive = ($this->uri->segment(5) == 2) ? 'lactive' : '';
								 
							  ?>
                                        
								 <?php
								  if (count ($analytics_data) > 0)
									  {
										
												   foreach ($analytics_data as $data)
													   {														  
														      $estabname = $data->{'estabname'};
														
														 	  $total_price_sum = $total_price_sum + $data->{'total_amount'};	
												
													          $order = $order + count($data->{'order_id'});
												
													   }
													  
									  }
									  
									// print_r($staff_reg);
									
									   if (count ($staff_reg) > 0)
										  {
											   foreach ($staff_reg as $staff)
												   {
														foreach ($staff as $staffid)
														   {	   
																$staffmember = $staffmember + count($staffid->{'staff_member_id'});
														   }
												   }		 
										  }

									 if ( ! empty ($response))
									  {
										 foreach ($response as $ldata)
										     {
													echo '<div class="pull-left" style="width:100%">
													       <p><strong>'.$ldata['name'].'</strong></p>';
																	
												    echo  '<div class="form-group">
															<div class="col-sm-12 text-left heght30">
															   <label class="col-sm-6 control-label">No. of Orders</label><div class="col-sm-6">'.$ldata['total_orders'].'</div>
															</div>
															</div>';
															
													echo  '<div class="form-group">
																<div class="col-sm-12 text-left heght30">
																   <label class="col-sm-6 control-label">Business Generated</label><div class="col-sm-6">Rs. '.$ldata['business_generated'].' /-</div>
																</div>
															</div>';
															
													$avg = $ldata['business_generated'] / date('d');
															
													echo  '<div class="form-group">
																<div class="col-sm-12 text-left heght30">
																   <label class="col-sm-6 control-label">Average Amount Spend/Day</label><div class="col-sm-6">'.$avg.'</div>
																</div>
															</div>';
															
													echo  '<div class="form-group">
																<div class="col-sm-12 text-left heght30">
																   <label class="col-sm-6 control-label">Average User Spend</label><div class="col-sm-6">'.$ldata['avg_user_spent'].'</div>
																</div>
															</div>';
															
													echo  '<div class="form-group">
																<div class="col-sm-12 text-left heght30">
																   <label class="col-sm-6 control-label">Total Staff Registered</label><div class="col-sm-6">'.$ldata['total_staff'].'</div>
																</div>
															</div>';
															
													echo  '<div class="form-group"><div class="col-sm-12 text-left heght30"><label class="col-sm-6 control-label"></label><div class="col-sm-6">&nbsp;</div></div></div>';	
															
													foreach ($ldata['analytic'] as $sdata)
														{
															 echo '<div class="form-group"><div class="col-sm-12 text-center heght30"><label class="col-sm-4 control-label"><span class="btn-circle">&nbsp;</span>'.ucwords($sdata['name']).'</label><div class="col-sm-8">&nbsp;</div></div></div>';
															
															
															 echo '<div class="form-group">
															            <div class="col-sm-2"></div>
																		<div class="col-sm-8 heght30">
																		   
																		   <div class="form-group"><div class="col-sm-12 text-left heght30"><label class="col-sm-6 control-label">No Of Orders: </label><div class="col-sm-6">'.$sdata['order'].'</div></div></div>
																		   
																		   <div class="form-group"><div class="col-sm-12 text-left heght30"><label class="col-sm-6 control-label">Business Generated: </label><div class="col-sm-6">Rs. '.$sdata['business'].'</div></div></div>
																		   
																		   <div class="form-group"><div class="col-sm-12 text-left heght30"><label class="col-sm-6 control-label">Avg Order Completion Time: </label><div class="col-sm-6">'.$sdata['avg_time'].'</div></div></div>
																		   
																		   
																		</div>
																		<div class="col-sm-2"></div>
																    </div>
																</div><div class="pull-left" style="height:30px;width:100%"></div>';
														}			
											 }
									  }
									  
									  else
										  {
											 echo '<div class="form-group">
														<div class="col-sm-12 text-center heght30">
														   <label class="col-sm-4 control-label">Sorry No Data Found .!</label><div class="col-sm-6"></div>
														</div>
												   </div>';
										  }
									  
									  
									 if (count ($staff_name) > 0)
									    {
											foreach ($staff_name as $staffname)
												{  
												        echo  "<li>".$staffname->{'name'};
													    echo form_open('', array('class' => 'form-horizontal')); 
														echo '<div class="form-group">
																	<div class="col-sm-12 text-center heght30">
																	   <label class="col-sm-4 control-label">No. of Orders</label><div class="col-sm-6">'; echo $order ; echo'</div>
																	</div>
																</div>';
														echo  '<div class="form-group">
															<div class="col-sm-12 text-center heght30">
															   <label class="col-sm-4 control-label">Business Generated</label><div class="col-sm-6">'; echo $total_price_sum; echo '</div>
															</div>
														</div>';
														echo  '<div class="form-group">
															<div class="col-sm-12 text-center heght30">
															   <label class="col-sm-4 control-label">Average Order Completion Time</label><div class="col-sm-6">'; echo $total_price_sum;echo '</div>
															</div>
														</div>';
														
														echo form_close();

														  "</li>";
														 
												}	
									    }
									  			
														echo "</ul><div class=\"pull-left\" style=\"height:30px;width:100%\"></div>";   
									
                                 
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
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/datepicker.js"></script>
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/datatables.min.js"></script>
	
	<script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
	
	
	<script>
		function branchStaff(value)
			{
				var locatn = value;
				location.href = "<?php echo base_url(); ?>index.php/locality/analytics/" + value;
				
			}
			
			function testclick(mnth)
			{
			var pathname = window.location.pathname;
alert(pathname); // alerts segment4
				location.href = "<?php echo base_url(); ?>index.php/locality/analytics/" + get_last_segmnt + "/" + mnth ;
			}
			
			
			function load(val)
				{
					if (val != '')
					location.href = "<?php echo base_url(); ?>index.php/locality/analytics/<?php echo $this->uri->segment(3); ?>" + "/" + val ;
				}

    </script>
</body>

</html>
			