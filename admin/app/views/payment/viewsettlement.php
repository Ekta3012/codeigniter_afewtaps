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
.prce{border:1px solid #888;padding:3px 18px;border-radius:4px}

.total{border:1px solid #888;padding:3px 8px;border-radius:4px}
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
							
							<div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;margin-bottom:20px">Payment Settlement</div>
							
							    <div class="row">
								     <div class="col-md-4"></div>
								     <div class="col-md-4">
										<?php 
										  if (count($estab) > 0)
											  {
												  echo '<select onchange="changeEstab(this.value)" class="form-control input-sm" style="height:35px">';
												  echo '<option  value="">-- Select --</option>';
												  foreach ($estab as $estab_data)
												  echo '<option '.(($estab_data->id == $this->uri->segment(3)) ? "selected='selected'" : "").'  value="'.$estab_data->id.'">'.$estab_data->name.'</option>';
												  echo '</select>';
											  }
										?>
									  </div>
								     <div class="col-md-4"></div>
								</div><br />
								
						        <?php echo validation_errors(); ?>
								<?php echo form_open('payment/index/'.$this->uri->segment(3), array('class' => 'form-horizontal')); ?>
							  	<div class="row" style="margin-bottom:20px">
								
												<div class="col-md-12">

												   <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
														<input type="text" name="start_date" class="form-control" placeholder="Start Date" id="start_date"value="<?php echo set_value('start_date'); ?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												   </div>
												  
												   <div class="col-md-3 input-group date" style="float:left;margin-right:10px">
													<input value="<?php echo set_value('end_date'); ?>" type="text" name="end_date" class="form-control" value="" placeholder="End Date" id="end_date"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
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
								
								
								<div class="ibox-content">

								<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
										<thead>
										<tr style="font-size:12px">
											<th>S No</th>
											<th>Order #</th>
											<th>Time &amp; Date</th>
											<th>Payment Method</th>
											<th>Amount</th>
											<th>Commission Rate</th>
											<th>Commission Amount</th>
											<th>Service Tax</th>
											<th>Amount Receivable</th>
										</tr>
										</thead>
										
										<tfoot>
										<tr>
										    <th colspan="1" >Total</th>

											<th colspan="4" style="text-align:right;border-right:none"></th>
											
											<th colspan="2" style="text-align:right;border-right:none"></th>

											<th colspan="2" style="text-align:right;border-right:none"></th>
											
										</tr>
										</tfoot>
		
		
										<tbody>
									<?php
								   if (count($payment['payment_data']) > 0)
									   {
										   $i = 0;
										   $total_price_sum = 0; 
										   foreach ($payment['payment_data'] as $data)
											   {
												   $i++;
												   
												   switch($data->{'payment_method'}){
													   case 1 :
													    $paymnt_method = "Credit Purchase";
													   break;
													   case 2 :
													    $paymnt_method = "COD";
													   break;
													   case 3 :
													   $paymnt_method = "Instamojo";
													   break;
												   }
												  
												   echo '<tr class="">
												            <td>'.$i.'</td>
															<td>'.$data->{'order_id'}.'</td>
															<td>'.date('h:i A, M d Y', $data->order_time).'</td>
															<td>'.$paymnt_method.'</td>
															<td>'.$data->{'total_amount'}.'</td>
															<td>---</td>
															<td>---</td>
															<td>'.(($data->{'service_tax'} != '') ? $data->{'service_tax'} : '---').'</td>
															<td>'.$data->{'total_amount'}.'</td>';
														 /*foreach ($payment['pay_tax'] as $tax)
															 
											      {
													 
													  foreach ($tax as $tax_rate)
															 
											      {
													  if($data->{'userid'}==$tax_rate->{'userid'})
												   {
													 
													echo  '<td>'.$tax_rate->{'commission_rate'}.'</td>';
												   }
												   }
												   
												  }
														$comm_amount = ($data->{'total_amount'} / 100) * $tax_rate->{'commission_rate'};
														
														$tax = ($data->{'total_amount'} / 100) * '6%';
														//echo $tax;
														$total_price_sum = $total_price_sum + $data->{'total_amount'};
														$comm_amount_sum = $comm_amount_sum + $comm_amount;
														$recive_amount = $data->{'total_amount'} + $comm_amount + $tax;
														
															$recive_amount_sum = $recive_amount_sum + $recive_amount;
														
															echo '<td>'.$comm_amount.'</td>
															
															
															<td>6%</td>
															<td>'.$recive_amount.'</td>
														
															
														
														 </tr>';
														 */
														 
														 
														
														 
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
									
									     <!--<div class="row">
												<div class="col-md-6">
												<span class="total">Total</span>
												</div>
												<div class="col-md-2">
											  <?php echo '<span class="prce">'. $total_price_sum.'</span>'; ?>
												</div>
												  <div class="col-md-2">
											  <?php echo '<span class="prce">---</span>'; ?>
												</div>
												  <div class="col-md-2">
											  <?php echo '<span class="prce">---</span>'; ?>
												</div>

										 </div>  --> 
										 
										 
										 
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
				
				 "footerCallback": function ( row, data, start, end, display ) {
					var api = this.api(), data;
		 
					// Remove the formatting to get integer data for summation
					var intVal = function ( i ) {
						return typeof i === 'string' ?
							i.replace(/[\$,]/g, '')*1 :
							typeof i === 'number' ?
								i : 0;
					};
		 
					// Total over all pages
					total = api
						.column( 4 )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
		 
					// Total over this page
					pageTotal = api
						.column( 4, { page: 'current'} )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
						
					comTotal = api
						.column( 6, { page: 'current'} )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
						
					amtRcvd = api
						.column( 8, { page: 'current'} )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
		 
					// Update footer
					$( api.column( 4 ).footer() ).html(pageTotal.toFixed(2));
					
					//$( api.column( 6 ).footer() ).html(comTotal.toFixed(2));
					
					$( api.column( 8 ).footer() ).html(amtRcvd.toFixed(2));
				},
		
		
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
		function changeEstab(value)
			{
				location.href = "<?php echo base_url(); ?>index.php/payment/index/" + value;
			}		
			
    </script>
	
</body>

</html>
			