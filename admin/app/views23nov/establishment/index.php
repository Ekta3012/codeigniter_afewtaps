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
	<link href="<?php echo config_item('base_url'); ?>assets/css/switchery.css" rel="stylesheet">
	
	<style>
	.badge1{background:url('../../assets/img/notification.png');background-repeat:no-repeat;float:right;background-position:center center;cursor:pointer;width:20px;height:20px;margin-top:10px}
	.badge{margin-right:-10px;margin-top:-10px}
	</style>
</head>

<body>
    <div id="wrapper">
        <?php $this->load->view('include/inc_navigation'); ?>
        <div id="page-wrapper" class="gray-bg sidebar-content">
            <div class="row border-bottom">
                <?php $this->load->view('include/inc_topnav'); ?>
            </div>
			
            <!--<div class="sidebard-panel">
                <?php $this->load->view('include/inc_sidebar'); ?>
            </div>-->
			
			 <div id="toggle" style="display:none;position:absolute;right:230px;top:60px;text-align:right"><a href="javascript:void(0);" style="cursor:pointer"><strong>Hide</strong></a></div>
		 
		     <div class="badge1" id=""></i><span id="notfiyCount" style="cursor:pointer" class="badge badge-info pull-right"></span></div>
		
	         <div class="sidebard-panel" style="display:none">
                <?php $this->load->view('include/inc_sidebar'); ?>
             </div>
		 
			
           <div class="wrapper wrapper-content" id="leftWrapper" style="padding-right:0;padding-top:30px">
            <div class="row">
                 <!-- Table -->
				     <div class="col-lg-12">
							<div class="ibox float-e-margins">	
							  <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">Home</div>
							
								<div class="ibox-content">
                                 
							
									
                                 <div class="row">
                                  <?php echo validation_errors(); ?>
							
							<?php echo form_open('', array('class' => 'form-horizontal')); ?>
										<div class="col-md-12">

										  <div class="col-md-4 input-group res_name" style="float:left;margin-right:3px">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="res_name" class="form-control fnt12" placeholder="Establishment Name" id="res_name">
										  </div>
                                            <div class="col-md-2 text-left" style="float:left;margin-right:3px">
											 <input type="submit" class="btn btn-primary" value="Filter" />
										  </div>   
                                          </div>
                                          
                                           <?php echo form_close(); ?>
                                          </div>
                                <div class="table-responsive">
                               
								<table class="table table-striped table-bordered table-hover dataTables-example" data-plugin-options='{"searchPlaceholder": "Suchen"}' >
                                <thead>
								<tr>
									<th>S No</th>
								
									<th>Time &amp; Date</th>
                                    <th>Establishment Name</th>
                                    <th>Payment Method</th>
                                    
									<th>Order Id</th>
									<th>Accepted</th>
									<th>Customer Name</th>
									
									
                                   
								</tr>
								</thead>
								<tbody>
                                
                               <?php
								 if (count ($order['orders']) > 0)
									  {
										 foreach ($order['orders'] as $ordata)
											   {
												  
											  
								if(count($order['estab'])>0)
								{
									 //echo $data->{'estabname'};
								?>
                                  
                                      <?php
									 $i = 0;
							foreach ($order['estab'] as $data)
											   {
												 foreach($data as $getdata)
												 {
												 
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
												   if($ordata->{'estabid'}==$getdata->{'establishment_id'})
												   {
													   
													 
							                           echo '<tr class="">
												            <td>'.$i.'</td>
															
														<td>'.date('h:i A, M d Y', $getdata->order_time).'</td>
														<td>'.$ordata->{'estabname'}.'</td>
														<td>'.$paymnt_method.'</td>
														<td><a href="'.base_url().'index.php/establishment/view/'.$getdata->{'order_id'}.'">'.$getdata->{'order_id'}.'</a></td>
													    <td>'. $status.'</td>';
														
														foreach ($order['cust_name'] as $data)
											   {
												 foreach($data as $getdata)
												 {
														
														echo '<td>'.$getdata->{'name'}.'</td>';
											
											
												 }
												 
											   }
												   }
							   } 
											   }
								 
												  
												   }
											    else
									   {
										           echo '<tr class="">
												            <td colspan=\'6\'>No Data.</td>
												            <td><input type="checkbox" class="js-switch" checked /></td>
												            <td><button class="btn btn-primary"><i class="fa fa-edit"></i> </button> <button class="btn btn-danger"><i class="fa fa-trash"></i> </button></td>
														 </tr>';
									  
								/**/
							?>
							
                                <?php }  }
									  } ?>
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
    	<script src="<?php echo config_item('base_url'); ?>assets/js/switchery.js"></script>
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
</body>
</html>

