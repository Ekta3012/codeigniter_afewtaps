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
<link href="<?php echo config_item('base_url'); ?>assets/css/switchery.css" rel="stylesheet">

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
.active{background-color:#E2E2E2;color:#404040;box-shadow:none !important}
.nonactive{background-color:#404040;color:#FFF}
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
								  
								  <?php
								    $segment = (int) $this->uri->segment(3);
									 switch ($segment)
										 {
											case 'inside':
											            $insideitem    = 'active';
														break;
											case 'analytics':
											            $analyticsitem    = 'active';
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
                                   <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside"><button class="btn btn-w-m <?php echo isset($insideitem) ? $insideitem : "nonactive" ; ?>" data-attr="inside" type="button">Inside Information</button></a>
                                    <a href="<?php echo base_url(); ?>index.php/establishmentdata/analytics"><button class="btn btn-w-m <?php echo isset($analyticsitem) ? $analyticsitem : "nonactive" ; ?>" data-attr="analytics" type="button">Analytics</button></a>
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/menu/1"><button class="btn btn-w-m <?php echo isset($menuitem) ? $menuitem : "nonactive" ; ?>" data-attr="menu/1" type="button">Menu Items</button></a>
                                              
                                                   <a href="<?php echo base_url(); ?>index.php/establishmentdata/merchant"><button class="btn btn-w-m <?php echo isset($merchantinfor) ? $merchantinfor : "nonactive" ; ?>" data-attr="merchant" type="button">Merchant Information</button></a>

								  </div>
								 	
                                   <!--  <div class="row"><a href="<?php //echo base_url(); ?>index.php/establishmentdata/addmenu"><button class="addMenu btn btn-w-m" data-attr="1" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Menu Items</button></a></div>-->
								<?php

										 $segment = (int) $this->uri->segment(3);
									 switch ($segment)
										 {
											 case 0: 
											 case 1:
											            $food_active       = 'active';
														break;
											 case 2:
														$beverages_active  = 'active';
														break;
											 case 'favfood':
											            $favfood_active    = 'active';
														break;
										 }
										
										
										
										?>
                                          <div class="row text-center">
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside/1"><button class="btn btn-w-m <?php echo isset($food_active) ? $food_active : "nonactive" ; ?>" data-attr="1" type="button">Service Rating Table</button></a>
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside/2"><button class="btn btn-w-m <?php echo isset($beverages_active) ? $beverages_active : "nonactive" ; ?>" data-attr="2" type="button">Average Order Completion Time</button></a>
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside/favfood"><button class="btn btn-w-m <?php echo isset($favfood_active) ? $favfood_active : "nonactive" ; ?>" data-attr="favfood" type="button">Favorite Food</button></a>
                                      <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside/4"><button class="btn btn-w-m <?php echo isset($dessert_active) ? $dessert_active : "nonactive" ; ?>" data-attr="4" type="button">New & Returning Customers</button></a>

								  </div>
									<?php

										 $segment = (int) $this->uri->segment(3);
									 switch ($segment)
										 {
											 case 0: 
											 case 1:
											            $food_active       = 'active';
														break;
											 case 2:
														$beverages_active  = 'active';
														break;
											 case 3:
											            $dessert_active    = 'active';
														break;
										 }
										
										
										
										?>
                                          <div class="row text-center">
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/favfood/1"><button class="btn btn-w-m <?php echo isset($food_active) ? $food_active : "nonactive" ; ?>" data-attr="1" type="button">Food</button></a>
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/favfood/2"><button class="btn btn-w-m <?php echo isset($beverages_active) ? $beverages_active : "nonactive" ; ?>" data-attr="2" type="button">Beverages</button></a>
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/favfood/3"><button class="btn btn-w-m <?php echo isset($dessert_active) ? $dessert_active : "nonactive" ; ?>" data-attr="3" type="button">Dessert</button></a>

								  </div>
                                <div class="row">
												  <div style="height:200px;width:400px;margin:20px 0 0 0" id="container"></div>
											</div>
                                  
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
								 if (count ($result['items']) > 0)
									  {
										 $i = 0;
								    foreach ($result['items'] as $key => $item_data)
										{
											 $i++;
											 foreach ($item_data as $item_result)
												{  
												 echo '<tr class="">
												            <td>'.$i.'</td>
															
															<td>'.ucwords($item_result->item_name).'</td>
															
															<td>'.ucwords($item_result->item_name).'</td>
															
															
														 </tr>';
												}
										}
										
									  }
									    else
									   {
										           echo '<tr class="">
												            <td>Sorry, No Menu Items Found !</td>
												            <td></td>
												            <td></td>
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
    <script src="<?php echo config_item('base_url'); ?>assets/js/switchery.js"></script>
    
<script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    
	<script>
        $(document).ready(function(){
			
			var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });			
			
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
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
			
			$('#container').highcharts({
							chart: {
								type: 'column'
							},
							
							legend: {
								enabled: false
							},
							plotOptions: {
								series: {
									borderWidth: 0,
									dataLabels: {
										enabled: true,
										format: '{point.y}'
									}
								}
							},

						
							series: [{
						
								color: '#2A3F54',
								data: [{
									name: 'May',
									y: 15,
									drilldown: 'May'
								}, {
									name: 'Jun',
									y: 16,
									drilldown: 'Jun'
								}, {
									name: 'Jul',
									y: 19,
									drilldown: 'Jul'
								}, {
									name: 'Aug',
									y: 21,
									drilldown: 'Aug'
								}, {
									name: 'Sep',
									y: 22,
									drilldown: 'Sep'
								}]
							}],
						
						});	


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
			