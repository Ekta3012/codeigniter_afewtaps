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

.row.text-center {
    background-color: rgb(199, 199, 199);
    border-radius: 14px;
}
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
.row.text-center .active {
    background-color: rgb(42, 63, 84);
    border-radius: 7px;
    box-shadow: none !important;
    color: #fff;
    margin-top: 5px;
}
.nonactive{color:#000}
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

.btn-w-m{min-width:0}
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
							  <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Establishment Data</div>
							
								<div class="ibox-content">
								  <div class="row"></div>
								  
                                      <div class="row">
                                  <div class="col-md-4"></div>
                                                 	<div class="col-md-4">

                             <?php 
									$branches = getAllBranches();
									if (count($branches) > 0)
									  {
										 echo '<select class="form-control m-b" name="branch" onchange="branchStaff(this.value)">';
										 echo '<option value="">Select Establishment</option>';
										 foreach ($branches as $bdata)
										   {
											 
											   $selected = ($this->uri->segment('3') == $bdata->{'userid'}) ? "selected='selected'" : "" ;
											   echo "<option $selected value='".$bdata->{'userid'}."'>".$bdata->{'name'}."</option>";
										   }
										   echo '</select>';
									  }
									   $userid = $this->uri->segment('3') ;
								?>
                                          </div>
                                           
										<div class="col-md-4"></div>		   
											     </div>
                                  
                                  
								   <?php
								
								     $segment =  $this->uri->segment(2);
									 switch ($segment)
										 {
											  case 'order':
											            $orderitem    = 'active';
														break;
											case 'inside':
											            $insideitem    = 'active';
														break;
											case 'analytics':
											            $analyticsitem    = 'active';
														break;
											case 'ratings':
											            $ratingsitem    = 'active';
														break;
											case 'menu/1':
											            $menuitem    = 'active';
														break;
											
											case 'merchant':
											            $merchantinfor    = 'active';
														break;
														
														
										 }
								  ?>
							  <div class="row text-center">
                              <a href="<?php echo base_url(); ?>index.php/establishmentdata/order"><button class="btn btn-w-m <?php echo isset($orderitem) ? $orderitem : "nonactive" ; ?>" data-attr="order" type="button">Order History</button></a>
                                   <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside"><button class="btn btn-w-m <?php echo isset($insideitem) ? $insideitem : "nonactive" ; ?>" data-attr="inside" type="button">Inside Information</button></a>
                                    <a href="<?php echo base_url(); ?>index.php/establishmentdata/analytics"><button class="btn btn-w-m <?php echo isset($analyticsitem) ? $analyticsitem : "nonactive" ; ?>" data-attr="analytics" type="button">Analytics</button></a>
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/ratings"><button class="btn btn-w-m <?php echo isset($ratingsitem) ? $ratingsitem : "nonactive" ; ?>" data-attr="ratings" type="button">Ratings</button></a>
                                    
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/menu/1"><button class="btn btn-w-m <?php echo isset($menuitem) ? $menuitem : "nonactive" ; ?>" data-attr="menu/1" type="button">Menu Items</button></a>
                                              
                                                   <a href="<?php echo base_url(); ?>index.php/establishmentdata/merchant"><button class="btn btn-w-m <?php echo isset($merchantinfor) ? $merchantinfor : "nonactive" ; ?>" data-attr="merchant" type="button">Merchant Information</button></a>

								  </div>
                                 
                                  
								<?php
								  echo ($this->session->flashdata('minfoupd') != '') ? '<div style=\'line-height:28px;margin:5px 0 20px 0\' class=\'btn-primary btn-xs\'><i class="fa fa-check"></i> Your Information has been updated successfully.</div>' : '';
								
								  if (count ($merchnt) > 0)
									  {
										  foreach ($merchnt as $data)
													   {
														   echo validation_errors();
														   
													echo form_open('', array('class' => 'form-horizontal')); 
													
														   echo  '<div class="form-group">
								    <div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">Contact Person</label><div class="col-sm-6">'; echo $data->{'contact_person'}; echo'</div>
									</div>
								</div>';
								echo  '<div class="form-group">
								    <div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">Contact Number</label><div class="col-sm-6">'; echo $data->{'contact_no'};echo '</div>
									</div>
								</div>';
								echo  '<div class="form-group">
								    <div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">Email Id</label><div class="col-sm-6">'; echo $data->{'email'};echo '</div>
									</div>
								</div>';
								echo  '<div class="form-group">
								    <div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">Beneficiary Name</label><div class="col-sm-6">'; echo $data->{'beneficiary_name'};echo '</div>
									</div>
								</div>';
								echo  '<div class="form-group">
								    <div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">Bank Name</label><div class="col-sm-6">'; echo $data->{'bank_name'}; echo'</div>
									</div>
								</div>';
								echo  '<div class="form-group">
								    <div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">Bank Account No</label><div class="col-sm-6">'; echo $data->{'bank_ac_no'}; echo'</div>
									</div>
								</div>';
								echo  '<div class="form-group">
								    <div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">IFSC/ SWIFT Code</label><div class="col-sm-6">'; echo $data->{'ifsc_swift_code'}; echo'</div>
									</div>
								</div>';
								echo  '<div class="form-group">
								    <div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">Account Type</label><div class="col-sm-6">'; if($data->{'account_type'}==1) 
									   {
										   echo "Current Account";
									   }
									   elseif($data->{'account_type'}==2)
									   {
										   echo "Saving Account";
									   }
									   
									   echo '</div>
									</div>
								</div>';
							
								echo  '<div class="form-group">
								    <div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">Merchant TAN Details</label><div class="col-sm-6">'; echo $data->{'merchant_tan'}; echo'</div>
									</div>
								</div>'; ?>
							
							<div class="form-group"> <div class="col-sm-12 text-center heght30"><label class="col-sm-4 control-label">Commission Collection Start Date</label>

                                    <div class="col-sm-8 input-group date">
									  <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="com_col_strt_dt" value="<?php echo isset($data->{'com_col_start_dt'}) ? date('m/d/Y', $data->{'com_col_start_dt'}) : date('m/d/Y'); ?>" class="form-control" />
									</div></div>
                                </div>
								
								<div class="form-group"> <div class="col-sm-12 text-center heght30"><label class="col-sm-4 control-label">Commission Slab (Based on Ratings)</label>

                                    <div class="col-sm-8 input-group"><input type="text" placeholder="Commission Slab (Based on Ratings)" name="com_slab" class="form-control" value="<?php echo isset($data->{'com_slab'}) ? $data->{'com_slab'} : set_value('com_slab'); ?>" style=" border-radius: 6px;" /></div>
                                </div></div>
                                
                                    <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
								<?php echo form_close();
														   
													   }
									  }
									 else
										 {
											 echo "<br /><h2>Sorry, No Merchant Information Found !</h2>";
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
    <script src="<?php echo config_item('base_url'); ?>assets/js/datepicker.js"></script>
	
	<script>
		function branchStaff(value)
			{
				 var userid=value;
				location.href = "<?php echo base_url(); ?>index.php/establishmentdata/merchant/" + value;
				
				
				
			}
			   $(document).ready(function () {
             
				var date = new Date();
				$('.input-group.date').datepicker({
						todayBtn: "linked",
						keyboardNavigation: false,
						forceParse: false,
						calendarWeeks: true,
						autoclose: true,
						startDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()),
						endDate:0
				});
				
				
            });
				
    </script>
	
</body>

</html>
			