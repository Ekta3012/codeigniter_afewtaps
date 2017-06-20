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
.total {
    border: 1px solid #888;
    border-radius: 4px;
    padding: 3px 8px;
}
.prce{
    border: 1px solid #888;
    border-radius: 4px;
    padding: 3px 8px;
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
		
        <div class="wrapper wrapper-content">
            <div class="row">
                 <!-- Table -->
				     <div class="col-lg-12">
							<div class="ibox float-e-margins">	
							  <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Establishment Data</div>
							
								<div class="ibox-content">
                                 
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
								  $segment = $this->uri->segment(2);
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
                                  <a href="<?php echo base_url(); ?>index.php/establishmentdata/order/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($orderitem) ? $orderitem : "nonactive" ; ?>" data-attr="order" type="button">Order History</button></a>
                                  
                                   <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($insideitem) ? $insideitem : "nonactive" ; ?>" data-attr="inside" type="button">Inside Information</button></a>
                                    <a href="<?php echo base_url(); ?>index.php/establishmentdata/analytics/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($analyticsitem) ? $analyticsitem : "nonactive" ; ?>" data-attr="analytics" type="button">Analytics</button></a>
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/ratings/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($ratingsitem) ? $ratingsitem : "nonactive" ; ?>" data-attr="ratings" type="button">Ratings</button></a>
                                    
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/menu/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($menuitem) ? $menuitem : "nonactive" ; ?>" data-attr="menu/1" type="button">Menu Items</button></a>
									 
									 <a href="<?php echo base_url(); ?>index.php/establishmentdata/location"><button class="btn <?php echo isset($locationitem) ? $locationitem : "nonactive" ; ?>" data-attr="menu/1" type="button">Location</button></a>
									 
									 
                                              
                                    <a href="<?php echo base_url(); ?>index.php/establishmentdata/merchant"><button class="btn btn-w-m <?php echo isset($merchantinfor) ? $merchantinfor : "nonactive" ; ?>" data-attr="merchant" type="button">Merchant Information</button></a>

								  </div>
							
                                    
                                    
                           
                                <div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
									<thead>
										<tr style="font-size:12px">
											<th>S No</th>
											<th>Order #</th>
											<th>Time &amp; Date</th>
											<th>Location</th>
											<th>Delivery Status</th>
											<th>Payment Method</th>
											<th>Amount</th>
											<th>Customer Name</th>
											<th>Receipt</th>
										</tr>
									</thead>
									
									<tfoot>
										<tr>
										    <th colspan="1" >Total</th>

											<th colspan="6" style="text-align:right;border-right:none"></th>
											<th colspan="2" style="text-align:right;border-right:none"></th>
											
										</tr>
										</tfoot>
										
										
								<tbody>
                                
                                <?php 
								
								 	 if (count ($order['orders']) > 0)
									  {
										  $i=0;
										 foreach ($order['orders'] as $ordata)
											   {
												   switch($ordata->{'payment_method'}){
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
												   switch($ordata->{'status'}){
													   case 1 :
													    $status = "In Preparation";
													   break;
													   case 2 :
													    $status = "In Priority";
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
													    $i++;
													 
													echo '<tr class="">
												            <td>'.$i.'</td>
															<td><a href="'.base_url().'index.php/establishmentdata/history/'.$ordata->{'order_id'}.'">'.$ordata->{'order_id'}.'</a></td>
															<td>'.date('h:i A, M d Y', $ordata->order_time).'</td>
															<td>'.$ordata->{'location'}.'</td>
															<td>'.$status.'</td>
															<td>'.$paymnt_method.'</td>
															<td>'.$ordata->{'total_amount'}.'</td>';
													
													/*foreach ($order['cust_name'] as $cust_name)
													   {
														 foreach($cust_name as $getcustname)
															 {
															
																if ($ordata->customer_id == $getcustname->{'id'}) 
																 {
																	  echo  '<td>'. $getcustname->{'name'} .'</td>';
																 } 
						
															 }
													   }*/
													   
													            echo  '<td>---</td>';
											  
																echo   '<td><a href="'.base_url().'index.php/establishmentdata/history/'.$ordata->{'order_id'}.'">View</a></td>';
																$total_price_sum = $total_price_sum + $ordata->{'total_amount'}; 
												 
											  }	  	   
									  }
											    else
												   {
														   echo '<tr class="">
																	<td colspan=\'12\'>No Data.</td>
																   
																 </tr>';
												  
												   }/**/    	
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
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/datatables.min.js"></script>
	
	<script src="<?php echo config_item('base_url'); ?>assets/js/datepicker.js"></script>
    <script src="<?php echo config_item('base_url'); ?>assets/js/switchery.js"></script>
    
    <script>
	
        $(document).ready(function(){
			
			var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });			
			
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
						.column( 6 )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
		 
					// Total over this page
					pageTotal = api
						.column( 6, { page: 'current'} )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
					
					$( api.column( 6 ).footer() ).html(pageTotal.toFixed(2));
				},
				
				
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
	
	<script>
		function branchStaff(value)
			{
				location.href = "<?php echo base_url(); ?>index.php/establishmentdata/order/" + value;
			}
    </script>
	
</body>

</html>
			