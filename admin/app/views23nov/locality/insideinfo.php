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
th {
  text-align: center;
}
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
.row {
    margin-bottom: 20px;
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
	   
	    <div class="sidebard-panel">
                <?php $this->load->view('include/inc_sidebar'); ?>
        </div>
		
        <div class="wrapper wrapper-content" id="leftWrapper">
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
											
											case 'lists':
											            $lists    = 'active';
														break;
											case 'summary':
											            $summary    = 'active';
														break;
											case 'order':
											            $order    = 'active';
														break;
											case 'analytics':
											            $analytics1    = 'active';
														break;
											
											case 'insideinfo':
											            $insideinfo    = 'active';
														break;
														
										 }
								  ?>
								   <div class="row text-center">
									
                                             <a href="<?php echo base_url(); ?>index.php/locality/lists/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($lists) ? $lists : "nonactive" ; ?>" data-attr="lists" type="button">List of Restaurant</button></a>
                                             
                                              <a href="<?php echo base_url(); ?>index.php/locality/summary/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($summary) ? $summary : "nonactive" ; ?>" data-attr="summary" type="button">Summary</button></a>
                                             
                                              <a href="<?php echo base_url(); ?>index.php/locality/order/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($order) ? $order : "nonactive" ; ?>" data-attr="order" type="button">Order History</button></a>
                                                <a href="<?php echo base_url(); ?>index.php/locality/analytics/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($analytics1) ? $analytics1 : "nonactive" ; ?>" data-attr="analytics" type="button">Analytics</button></a>
                                              
                                               <a href="<?php echo base_url(); ?>index.php/locality/insideinfo/<?php echo $this->uri->segment(3); ?>"><button class="btn btn-w-m <?php echo isset($insideinfo) ? $insideinfo : "nonactive" ; ?>" data-attr="insideinfo" type="button">Inside Information</button></a>
                                           

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
		                                 
											if($loclist!='')
		                                    {  
											
										  	 foreach ($analytics as $bdata)
										   {
											
										?>
                                           
                                          <option <?php echo (set_value('estab') == $bdata->{'id'}) ? "selected='selected'" : "" ; ?>  value="<?php echo $bdata->{'id'}; ?>"><?php echo $bdata->{'name'}; ?></option>  
                                           
                                            
                                                
                                               <?php  } }
											    ?>   
                                          
                                                </select>  
										  </div>
                                            <div class="col-md-2 text-left" style="float:left;margin-right:3px">
											 <input type="submit" class="btn btn-primary" value="Submit" />
										  </div>   
                                          </div>
                                           
                                     <?php  echo form_close(); ?>
                                          </div>
                              
                                          		<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<th>S No</th>
									<th>Customer Id</th>
                                    <th>Establishment Id</th>
                                    <th>Order Id</th>
                                    <th>Server Id</th>
								
									
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
												             <td>'.$i.'</td>';
												    echo	'<td>'.$data->{'customer_id'}.'</td>
														     <td>'.$data->{'establishment_id'}.'</td>
															 <td>'.$data->{'order_id'}.'</td>';
															 $k = 0;
															 foreach ($result['ser_id'] as $ser_id)
																  {
																	  foreach ($ser_id as $ser_name)
																		  {
																			  if($data->{'staff_member_id'} == $ser_name->{'id'})
																			    {
																				    echo  '<td>'.$ser_name->{'employee_id'}.'</td>';
																					$k = 1;
																			    }
																		   }
																  }
															
															 if ($k == 0)
															 echo '<td>---</td>';
															 
													echo	 '</tr>';
											    }
									  
									   }
								   else
									   {
										           echo '<tr class="">
												            <td colspan=\'6\'>No Data.</td>
														 </tr>';
									   }
								?>
								
								
								</tbody>
								
                                
								</table>
									</div>
                                    <?php   
                             if (count($result['order']) > 0)
									   {?>
                                    
                                        <div class="row">
                                      <div class="col-md-12">
                                      <ul>
                                      <li>  <div class="col-md-6">Average Order Completion Time</div><div class="col-md-6"><?php foreach ($result['order'] as $data)
											   {
												  
												 $timestamp = mktime($data->{'completion_time'});
                                                    $totaltime += $timestamp;
												// date('h:i', $data->{'completion_time'});
											
											   }
											   $average_time = ($totaltime/count($data->{'completion_time'}));

echo date('H:i',$average_time);
                                               ?>
                                               </div></li>
                                       <li>  <div class="col-md-12">Top F & B Items Sold</div></li>
                                     <div class="col-md-12">
<?php   

                            if (count($result['item_sold']) > 0)
									   { ?>
                                <table class="table table-striped table-bordered table-hover dataTables-example">
								<thead>
								<tr>
									<th>S No</th>
									<th>Item Name</th>
                                    <th>Sales Unit</th>
                                  
								</tr>
								</thead>
								<tbody>
								
							<?php
								
								 
										   $i = 0;
										   foreach ($result['item_sold'] as $itemsold)
											   {
												    
												   $i++;
												   
												  
												   echo '<tr class="">
												            <td>'.$i.'</td>';
															
														echo	'<td>'.$itemsold->{'item_name'}.'</td>
														<td>'.$itemsold->{'quantity'}.'</td>';
																
												
													echo	 '</tr>';
											 
											   }
									  
									  
								  
									  
								?>
								
								
								</tbody>
								
								</table>
								<?php } ?>
                                </div>
                                
                                <div class="col-md-12"> <li>  <div class="col-md-12">New & Returning Customers</div></li></div>
                                
                           <div class="col-md-12">
                                <?php   
						//print_r($result['cust']);
                            if (count($result['cust']) > 0)
									   { ?>
                                <table class="table table-striped table-bordered table-hover" style="border-radius:6px;">
								<thead>
								<tr>
									<th align="center">S No</th>
									<th align="center">New Customers</th>
                                    <th align="center">Returning Customers </th>
                                  
								</tr>
								</thead>
								<tbody>
								
							<?php
								
										   foreach ($result['cust'] as $data)
											   {
												    foreach ($data as $twocust)
											   {
												
												
															
														if($twocust->{'customers'}>1)
														{
															$gt =  count($twocust->{'customer_id'});	
															 $retrun = $retrun + $gt ;
														}
														else if($twocust->{'customers'}==1)
														{
															$gt =  count($twocust->{'customer_id'});	
															 $new = $new + $gt ;
														}
											   }
											   }
											   ?>
									  <tr>
									<td align="center">1</td>
									<td align="center"><?php if($new!='') { echo $new; } else { echo "---"; } ?></td>
                                    <td align="center"><?php if($retrun!='') { echo $retrun; } else { echo "---"; } ?></td>
                                  
								</tr>
									  
									
								
								
								</tbody>
								
								</table>
								<?php } ?>
                                </div>
                        
                                </ul>
                                      
                                      
                                      </div>
                                
								</div>
								<?php } ?>
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
		function branchStaff(value)
			{
				
				location.href = "<?php echo base_url(); ?>index.php/locality/insideinfo/" + value;
				
				
				
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
	
</body>

</html>
			