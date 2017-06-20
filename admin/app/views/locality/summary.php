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

<link href="<?php echo config_item('base_url'); ?>assets/css/switchery.css" rel="stylesheet">

<style>
.row.text-center {
    background-color: rgb(199, 199, 199);
    borderdta-radius: 14px;
	 margin-bottom: 20px;
}
.row.text-center .active {
    background-color: rgb(42, 63, 84);
    borderdta-radius: 7px;
    box-shadow: none !important;
    color: #fff;
    margin-top: 5px;
}
.nonactive{color:#000}
#slide{
borderdta:1.5px solid black;
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
.liactive {borderdta-bottom:2px solid #404040;cursor:not-allowed !important}
.lclr{color:#676a6c !important;font-weight:bold}
.lactive{color:#676a6c !important;font-weight:bold}
</style>
</head>
<body>

    <div id="wrapper">
       <?php $this->load->view('include/inc_navigation'); ?>
      <div id="page-wrapper" class="gray-bg sidebar-content">
       <div class="row borderdta-bottom">
	   <?php $this->load->view('include/inc_topnav'); ?>
       </div>

		
        <div class="wrapper wrapper-content"  style="padding-right:0">
            <div class="row">
                 <!-- Table -->
				     <div class="col-lg-12">
							<div class="ibox float-e-margins">	
							  <div class="bar brdrad5" style="borderdta-bottom-left-radius:0;borderdta-bottom-right-radius:0;">Locality Information</div>
								<div class="ibox-content">
								   <div class="row">
										  <div class="col-md-4"></div>
                                          <div class="col-md-4 text-center">
											<?php 
												$branches = getEstabLocation();
												if (count($branches) > 0)
												  {
													 echo '<select class="form-control m-b" name="branch" onchange="branchStaff(this.value)">';
													 echo '<option value="">--Select Location--</option>';
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
										     if ($this->uri->segment(3) != '')
											    {
													 switch ($this->uri->segment(2))
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
												
												
												<div class="row">
												  <?php echo validation_errors(); ?>
												  <?php echo form_open('', array('class' => 'form-horizontal')); ?>
													<div class="col-md-12">
														<div class="col-md-5"></div>
															<div class="col-md-4 input-group res_name" style="float:left;margin-right:3px">
																<select name="estab" class="form-control m-b" onchange="load(this.value)">
																 <option value="">Establishment Name</option>
																  <?php    
																	   foreach ($loc_analytcs as $bdata)
																		   {
																			   $sel = ($bdata->id == $this->uri->segment(4)) ? "selected='selected'" : "";
																			   echo '<option '.$sel.' value="'.$bdata->{'id'}.'">'.$bdata->{'name'}.'</option>';
																		   } 
																	?>   
																</select>  
															</div>
															<div class="col-md-2 text-left" style="float:left;margin-right:3px">
																 <!-- <input type="submit" class="btn btn-primary" value="Submit" /> -->
															</div>   
													</div>
													<?php  echo form_close(); ?>
												</div>
											<?php } ?>

												
										<?php
											if ($this->uri->segment(4) != '')	
											   {
												  $lmactive = ($this->uri->segment(5) == 1 || $this->uri->segment(5) == '') ? 'lclr' : '';
												  $nmactive = ($this->uri->segment(5) == 2) ? 'lactive' : '';
										?>					
												<div class="row">
												   <div class="col-sm-6 text-center" style="font-size:15px">
														<p> <?php echo date('F, Y'); ?></p></a>
												   </div>
												</div>
												
											
												<?php echo form_open(''); ?>
												<div class="row">
													<div class="col-md-12">

													  <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
															<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date" value="<?php echo set_value('start_date'); ?>" class="form-control" placeholder="Start Date" required id="start_date">
													  </div>
													  
													  <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="end_date" value="<?php echo set_value('end_date'); ?>" class="form-control" value="" placeholder="End Date" required id="end_date">
													  </div>
										
													  
													  <div class="col-md-3 text-left" style="float:left;margin-right:10px">
														 <input type="submit" class="btn btn-primary" value="Filter" id="filter1" />
													  </div>   
												   
													</div>
												</div>
											    <?php echo form_close(); ?>

												<div class="row">
			
												    <div class="form-group">
															<div class="col-sm-12 text-left heght30">
															   <label class="col-sm-4 control-label">Total No. of Orders</label><div class="col-sm-8"><?php echo (int) $summarydata['total_orders']; ?></div>
															</div>
													</div>
															
													<div class="form-group">
																<div class="col-sm-12 text-left heght30">
																   <label class="col-sm-4 control-label">Business Generated</label><div class="col-sm-8">Rs. <?php echo number_format((float)$summarydata['business'], 2, '.', ''); ?> /-</div>
																</div>
													</div>
															
													<?php
													  $avg = $summarydata['avg_amount_spend'];
													  $d   = date('d');
													  $avgs = $avg / $d ;
													?>
													<div class="form-group">
																<div class="col-sm-12 text-left heght30">
																   <label class="col-sm-4 control-label">Average Amount Spend/Day</label><div class="col-sm-8">Rs. <?php echo number_format((float)$avgs, 2, '.', ''); ?> /-</div>
																</div>
													</div>
															
													<div class="form-group">
																<div class="col-sm-12 text-left heght30">
																   <label class="col-sm-4 control-label">Average User Spend</label><div class="col-sm-8">Rs. <?php echo number_format((float)$summarydata['avg_user_spend'], 2, '.', ''); ?> /-</div>
																</div>
													</div>
															
															
													<div class="form-group"><div class="col-sm-12 text-left heght30"><label class="col-sm-6 control-label"></label><div class="col-sm-6">&nbsp;</div></div></div>
												</div>
												
												<hr />
												
												<div class="row">
												    <p><strong>Top F &amp; B items</strong></p>
													
													<div class="table-responsive">
														<table class="table table-striped table-bordered table-hover dataTables-example" >
															<thead>
															<tr>
																<th>S No</th>
																<th>Item Name</th>
																<th>Sales Unit</th>
															</tr>
															</thead>
															<tbody>
															<?php
															 if (count($summarydata['results']) > 0)
															   {
																 $i = 0 ;
																 foreach ($summarydata['results'] as $cdata)
																   {
																		$i++;
																		echo '<tr class="">
																				<td>'.$i.'</td>
																				<td>'.$cdata['name'].'</td>
																				<td>'.$cdata['qty'].'</td>
																			</tr>';
																   }
															   }
															   else
																   echo '<tr class="gradeX"><td colspan="3">No data found</td></tr>';
															?>  

															</tbody>
															<tfoot>
																<tr>
																	<th>S No</th>
																    <th>Item Name</th>
																    <th>Sales Unit</th>
																</tr>
															</tfoot>
														</table>
												    </div>
									

												</div>


												<?php
												 $total_cust = (int) $this->db->get_where($this->db->dbprefix('accounts'), array('status' => 1))->num_rows();
												?>
												<hr />
												
												<div class="row">
												    <p><strong>New &amp; Returning Customers</strong></p>
													
													<div class="form-group">
															<div class="col-sm-12 text-left heght30">
															   <label class="col-sm-4 control-label">Total New Customers</label><div class="col-sm-8"><?php echo (int) $total_cust; ?></div>
															</div>
													</div>
															
													<div class="form-group">
																<div class="col-sm-12 text-left heght30">
																   <label class="col-sm-4 control-label">Total Returning Customers</label><div class="col-sm-8"><?php echo (int) $summarydata['return_customer']; ?></div>
																</div>
													</div>
									

												</div>	

												
												<hr />
												
												
												<div class="row">
													<div class="col-sm-12 text-left heght30">
													   <label class="col-sm-4 control-label"></strong>Avg Order Completion Time</strong></label><div class="col-sm-8"><?php echo isset($summarydata['avg_order_completion_time']) ? $summarydata['avg_order_completion_time'] : '00:00'; ?></div>
													</div>
																
												</div>	
												

												

										  <?php
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
	
    <script src="<?php echo config_item('base_url'); ?>assets/js/datepicker.js"></script>
	<script src="<?php echo config_item('base_url'); ?>assets/js/datatables.min.js"></script>
	
	
    	<script src="<?php echo config_item('base_url'); ?>assets/js/switchery.js"></script>
    	<script>
		function branchStaff(value)
			{
				location.href = "<?php echo base_url(); ?>index.php/locality/summary/" + value;
			}
			
		function load(value)
			{
				location.href = "<?php echo base_url(); ?>index.php/locality/summary/<?php echo $this->uri->segment(3); ?>/" + value;
			}
			
			
    </script>
	<script>
       $(document).ready(function(){
		   
		    $('#start_date, #end_date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
			
			
			
			var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });			
			
            $('.dataTables-example').DataTable({
                 "pagingType": "full_numbers",
    'iDisplayLength': 10,
                buttons: [
                 
                    {
                     customize: function (win){
                            /*$(win.document.body).addClass('white-bg');*/
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
		$(document).ready(function(){
$('#start_date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#end_date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
        });
    </script>
	
</body>

</html>
			