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
<!--<link href="<?php echo config_item('base_url'); ?>assets/css/switchery.css" rel="stylesheet">-->

<style>
.row.text-center {
    background-color: rgb(199, 199, 199);
    border-radius: 14px;
	 margin-bottom: 20px;
}
.rows.text-center {
   
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
.row.text-center .nonactive{color:#000}
.rows.text-center .nonactive {
    background: #404040 none repeat scroll 0 0;
    color: #fff;  margin-bottom: 0 !important;
}
.rows.text-center .active {
 
background: rgb(199, 199, 199) none repeat scroll 0 0;
box-shadow: none !important;
color: #000;

    
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

.rows.text-center .active{margin-top:6px}

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
									           $userid = $this->uri->segment('3');
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
								 	
                                   <!--  <div class="row"><a href="<?php //echo base_url(); ?>index.php/establishmentdata/addmenu"><button class="addMenu btn btn-w-m" data-attr="1" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Menu Items</button></a></div>-->
								<?php

								     $segment = $this->uri->segment(4);
									 switch ($segment)
										 {
											 case 1:
											            $service_rating       = 'active';
														break;
											 case 2:
														$beverages_active  = 'active';
														break;
											
											 default:
											            $service_rating = 'active';
														break;
										 }

										?>
                                   <div class="rows text-center">
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside/<?php echo $this->uri->segment(3, 0); ?>/1"><button class="btn btn-w-m <?php echo isset($service_rating) ? $service_rating : "nonactive" ; ?>" data-attr="1" type="button">Service Rating Table</button></a>
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside/<?php echo $this->uri->segment(3, 0); ?>/2"><button class="btn btn-w-m <?php echo isset($beverages_active) ? $beverages_active : "nonactive" ; ?>" data-attr="2" type="button">Average Order Completion Time</button></a>
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/favfood/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($favfood_active) ? $favfood_active : "nonactive" ; ?>" data-attr="favfood" type="button">Favourite Food</button></a>
                                      <a href="<?php echo base_url(); ?>index.php/establishmentdata/customer/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($customer) ? $customer : "nonactive" ; ?>" data-attr="customer" type="button">New & Returning Customers</button></a>

								  </div>
										<div class="ibox-content">	 	
									<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr style="font-size:11px">
									 <th>S No</th>
									 <th>Customer Id</th>
                                     <th>Customer Name</th>  
                                     <th>Establishment Id</th>
                                     <th>Order #</th>
                                     <th>Server Id</th>
                                     <th>Server Name</th>
                                     <th>Establishment Rating</th>
									<!--<th>Establishment Rating</th>-->
								</tr>
								</thead>
								<tbody>
								
								<?php
								
								   if (count($result['order']) > 0)
									   {
										   $i = 0;
										   foreach ($result['order'] as $data)
											   {
												   $i++;

												   echo '<tr class="">
												            <td>'.$i.'</td>
															
															<td>'.$data->{'customer_id'}.'</td>
															
															<td>'.$data->{'name'}.'</td>';
															
														
														echo	'<td>'.$data->{'establishment_id'}.'</td>
																 <td>'.$data->{'order_id'}.'</td>';
													
															     foreach ($result['ser_id'] as $ser_id)
																    {
																	  foreach ($ser_id as $ser_name)
																		  {
																			  if ($data->{'staff_member_id'}==$ser_name->{'id'})
																				   {
																						echo  '<td>'.$ser_name->{'employee_id'}.'</td>';
																						echo  '<td>'.$ser_name->{'name'}.'</td>';
																				   }
																		   }
																    }
																  
												 // print_r($result['rating']);
												 foreach ($result['rating'] as $esbrating)
													    {
													 			echo  '<td>'.$esbrating->{'rating'}.'</td>';
														}
												} 			
														 '</tr>';
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
    
    	<script>
	var width = $('#slide').width() - 10;
		$('#slide').hover(function () {
			 $(this).stop().animate({left:"0px"},500);     
		   },function () {          
			 $(this).stop().animate({left: - width  },500);     
		});

		
		function showContainer(id)
			{
				$('div.slides ul li').removeClass('liactive');
				$('#cuisine_'+id).addClass('liactive');
				
				$('.menucontainer').css('display', 'none');
				$('#menucontainer' + id).css('display', 'block');
				
				
			}

	</script>
	<script>
		function branchStaff(value)
			{
				location.href = "<?php echo base_url(); ?>index.php/establishmentdata/inside/" + value;
			}
    </script>
</body>

</html>
			