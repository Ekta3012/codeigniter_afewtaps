<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo config_item('admin_page_title'); ?>Locality</title>
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
</style>
</head>
<body>

    <div id="wrapper">
       <?php $this->load->view('include/inc_navigation'); ?>
      <div id="page-wrapper" class="gray-bg sidebar-content">
       <div class="row borderdta-bottom">
	   <?php $this->load->view('include/inc_topnav'); ?>
       </div>
	   
	    <div class="sidebard-panel">
                <?php $this->load->view('include/inc_sidebar'); ?>
        </div>
		
        <div class="wrapper wrapper-content">
            <div class="row">
                 <!-- Table -->
				     <div class="col-lg-12">
							<div class="ibox float-e-margins">	
							  <div class="bar brdrad5" style="borderdta-bottom-left-radius:0;borderdta-bottom-right-radius:0;">Locality Information</div>
							
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
									$userid = $this->uri->segment('3') ;
								urldecode($userid);
									
									
									
								?>
                                          </div>
                                           
										<div class="col-md-4"></div>		   
											     </div>
								  
								 <?php
								   $segment =  $this->uri->segment(2);
									 switch ($segment)
										 {
											
											case 'lisst':
											            $lists    = 'active';
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
									
                                             <a href="<?php echo base_url(); ?>index.php/locality/lists"><button class="btn btn-w-m <?php echo isset($lists) ? $lists : "nonactive" ; ?>" data-attr="list" type="button">List of Restaurant</button></a>
                                             
                                             <a href="<?php echo base_url(); ?>index.php/locality/summary"><button class="btn btn-w-m <?php echo isset($summary) ? $summary : "nonactive" ; ?>" data-attr="summary" type="button">Summary</button></a>
                                             
                                              <a href="<?php echo base_url(); ?>index.php/locality/orderdta"><button class="btn btn-w-m <?php echo isset($order) ? $order : "nonactive" ; ?>" data-attr="orderdta" type="button">Order History</button></a>
                                                <a href="<?php echo base_url(); ?>index.php/locality/analytics"><button class="btn btn-w-m <?php echo isset($analytics) ? $analytics : "nonactive" ; ?>" data-attr="analytics" type="button">Analytics</button></a>
                                              
                                               <a href="<?php echo base_url(); ?>index.php/locality/insideinfo"><button class="btn btn-w-m <?php echo isset($insideinfo) ? $insideinfo : "nonactive" ; ?>" data-attr="insideinfo" type="button">Inside Information</button></a>
                                           

								  </div>
													
														
								
                                  <div class="row">
                                  <?php echo validation_errors(); ?>
							
							<?php echo form_open('', array('class' => 'form-horizontal')); ?>
										<div class="col-md-12">
<div class="col-md-5"></div>
										  <div class="col-md-4 input-group res_name" style="float:left;margin-right:3px">
												
                                                <select name="estab" class="form-control m-b">
                                                 <option value="">Establishment Name</option>
                                              <?php    
											  $userid = $this->uri->segment('3') ;
				                            $loclist = urldecode($userid);
		                                 
											  
											 if (count ($getorder['ordrestab']) > 0)
									  {
										 foreach ($getorder['ordrestab'] as $ordatadetails)
											   {
											
										?>
                                           
                                          <option value="<?php echo $ordatadetails->{'estabid'}; ?>"><?php echo $ordatadetails->{'estabname'}; ?></option>  
                                           
                                            
                                                
                                               <?php  }} ?>   
                                          
                                                </select>  
										  </div>
                                            <div class="col-md-2 text-left" style="float:left;margin-right:3px">
											 <input type="submit" class="btn btn-primary" value="Submit" />
										  </div>   
                                          </div>
                                           
                                     <?php  echo form_close(); ?>
                                          </div>
                                			 	
									
                                      <!-- 	<div class="row">
										<div class="col-md-12">
                                      <?php 
									  echo $this->input->get('estab');
									  echo validation_errors(); ?>
							
							<?php echo form_open('locality/orderdta', array('class' => 'form-horizontal')); ?>
										  <div class="col-md-2 input-group date" style="float:left;margin-right:3px">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="start_date" class="form-control fnt12" placeholder="Start Date" id="start_date">
										  </div>
										  
										  <div class="col-md-2 input-group date" style="float:left;margin-right:3px">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="end_date" class="form-control fnt12" value="" placeholder="End Date" id="end_date">
										  </div>
                                           <div class="col-md-2 input-group location" style="float:left;margin-right:3px">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="location" class="form-control fnt12" value="" placeholder="Location" id="location">
										  </div>
                                           <div class="col-md-3 input-group date" style="float:left;margin-right:3px">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="payment_method" class="form-control fnt12" value="" placeholder="Payment Method" id="payment_method">
										  </div>
					
										  
										  <div class="col-md-2 text-left" style="float:left;margin-right:3px">
											 <input type="submit" class="btn btn-primary" value="Filter" name="submit" />
										  </div>   
										   
  <?php echo form_close();?>
										 </div>
									 </div>-->
                                    
                               
                                 
                                
                             <div class="table-responsive">
                             	<table class="table table-striped table-bordered table-hover dataTables-example" >
                               	<thead>
								<tr>
									<th>S No</th>
									<th>Order Id</th>
									<th>Time &amp; Date</th>
                                    <th>Location</th>
                                    <th>Delivery Status</th>
                                    
									<th>Payment Method</th>
									<th>Amount</th>
									<th>Customer Name</th>
									<th>Receipt</th>
									
                                   
								</tr>
								</thead>
								<tbody>
                                
                                 <?php
							
							 //echo $ordatadetails->{'estabname'};  
								if(count($orderdta['estab'])>0)
								{
									 //echo $data->{'estabname'};
								?>
                                
                                <?php 
								//print_r($orderdta['estab']);
								 //  echo $ordata->{'estabname'};
								   ?>
                                  
                                
                                     
                                   <?php
									 $i = 0;
									// print_r($orderdta['estab']);
							foreach ($orderdta['estab'] as $data)
											   {
												   
												 foreach($data as $getdata)
												 {
												    $i++;
												   //echo $getdata->{'establishment_id'};
												  // echo $orderdta_tb->{'orderdta_id'};
												  
										  
												   
													  
												   switch($getdata->{'payment_method'}){
													   case 1 :
													    $paymnt_method = "Credit Purchase";
													   break;
													   case 2 :
													    $paymnt_method = "COD";
													   break;
													   case 3 :
													   $paymnt_method = "Payu";
													   break;
												   }
												   switch($getdata->{'status'}){
													   case 1 :
													    $status = "Preparation";
													   break;
													   case 2 :
													    $status = "Priority";
													   break;
													   case 3 :
													   $status = "Completed";
													   break;
													    case 4 :
													    $status = "Cancelled";
													   break;
													   case 5 :
													    $status = "Threshold";
													   break;
													   
												   }
												 
												  
													  
													 
							  echo '<tr class="">
												            <td>'.$i.'</td>
															
															<td><a href="'.base_url().'index.php/locality/history/'.$getdata->{'order_id'}.'">'.$getdata->{'order_id'}.'</a></td>
																<td>'.date('h:i A, M d Y', $getdata->orderdta_time).'</td>
															
															
															
															<td>'.$getdata->{'location'}.'</td>
															<td>'.$status.'</td>
																<td>'.$paymnt_method.'</td>
															<td>'.$getdata->{'total_amount'}.'</td>';
													
													foreach ($orderdta['cust_name'] as $cust_name)
											   {
												 foreach($cust_name as $getcustname)
												 {
															
											
												 echo  '<td>'.$getcustname->{'name'}.'</td>';
												 
												 }
											   }
												echo   '<td><a href="'.base_url().'index.php/locality/history/'.$getdata->{'order_id'}.'">View</a></td>';
												 
							   } 
											   }
								 
												  
												   }
											    else
									   {
										           echo '<tr class="">
												            <td colspan=\'12\'>No Data.</td>
												           
														 </tr>';
									   }
									  
								/**/
							?>
                            
								</tbody></table>
                              
								
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
	
    <script src="<?php echo config_item('base_url'); ?>assets/js/datepicker.js"></script>
	<script src="<?php echo config_item('base_url'); ?>assets/js/datatables.min.js"></script>
    	<script src="<?php echo config_item('base_url'); ?>assets/js/switchery.js"></script>
    	<script>
		function branchStaff(value)
			{
				location.href = "<?php echo base_url(); ?>index.php/locality/order/" + value;
			}
    </script>
	<script>
       $(document).ready(function(){
			
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
			