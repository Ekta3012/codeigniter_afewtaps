<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo config_item('admin_page_title'); ?>Menu</title>
<link href="<?php echo config_item('base_url'); ?>assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/animate.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/style.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/awesome-bootstrap-checkbox.css" rel="stylesheet">
<link href="<?php echo config_item('base_url'); ?>assets/css/datatables.min.css" rel="stylesheet">

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
                                   <a href="<?php echo base_url(); ?>index.php/establishmentdata/inside"><button class="btn btn-w-m <?php echo isset($insideitem) ? $insideitem : "nonactive" ; ?>" data-attr="inside" type="button">Inside Information</button></a>
                                    <a href="<?php echo base_url(); ?>index.php/establishmentdata/analytics"><button class="btn btn-w-m <?php echo isset($analyticsitem) ? $analyticsitem : "nonactive" ; ?>" data-attr="analytics" type="button">Analytics</button></a>
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/ratings"><button class="btn btn-w-m <?php echo isset($ratingsitem) ? $ratingsitem : "nonactive" ; ?>" data-attr="ratings" type="button">Ratings</button></a>
                                    
                                     <a href="<?php echo base_url(); ?>index.php/establishmentdata/menu/1"><button class="btn btn-w-m <?php echo isset($menuitem) ? $menuitem : "nonactive" ; ?>" data-attr="menu/1" type="button">Menu Items</button></a>
                                              
                                                   <a href="<?php echo base_url(); ?>index.php/establishmentdata/merchant"><button class="btn btn-w-m <?php echo isset($merchantinfor) ? $merchantinfor : "nonactive" ; ?>" data-attr="merchant" type="button">Merchant Information</button></a>

								  </div>
								 	
                                   <!--  <div class="row"><a href="<?php //echo base_url(); ?>index.php/establishmentdata/addmenu"><button class="addMenu btn btn-w-m" data-attr="1" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Menu Items</button></a></div>-->
								<br>
								
                                  <div class="row">
                                                 	<div class="col-md-12">

                             <?php 
									$branches = getAllBranches();
									if (count($branches) > 0)
									  {
										 echo '<select class="form-control m-b" name="branch" onchange="branchStaff(this.value)">';
										 echo '<option value="">-- Select Branch --</option>';
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
                                           
												   
											     </div>
                                
								
								<?php

										 $segment = (int) $this->uri->segment(4);
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
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/menu/<?php echo $this->uri->segment(3); ?>/1"><button class="btn btn-w-m <?php echo isset($food_active) ? $food_active : "nonactive" ; ?>" data-attr="1" type="button">Food</button></a>
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/menu/<?php echo $this->uri->segment(3); ?>/2"><button class="btn btn-w-m <?php echo isset($beverages_active) ? $beverages_active : "nonactive" ; ?>" data-attr="2" type="button">Beverages</button></a>
									  <a href="<?php echo base_url(); ?>index.php/establishmentdata/menu/<?php echo $this->uri->segment(3); ?>/3"><button class="btn btn-w-m <?php echo isset($dessert_active) ? $dessert_active : "nonactive" ; ?>" data-attr="3" type="button">Dessert</button></a>

								  </div>
											 	
								

							<?php	  print_r($result['category']);
							if (count ($result['category']) > 0)
									  {
										  echo '<div class="row">
												  <div class="col-md-12 col-md-offset-2">
													<div class="slides">
													  <ul>';
										  foreach ($result['category'] as $k => $category_data)
											  {
												  $active = ($k == 0) ? "liactive" :"";
												  echo "<li id=\"cuisine_".$category_data->cid."\" onclick=\"showContainer('".$category_data->cid."')\" class='".$active."'>".ucwords($category_data->category_name)."</li>";
										
												
											
												
											  }
											  
											
											
										  echo '</ul>
											 </div>
										   </div>
										</div>';
									  }
									 else
										 {
											 echo "<br /><h2>Sorry, No Menu Items Found !</h2>";
										 }
								  ?>			
								  
								  <div class="row" style="height:40px"></div>
								  <?php 
 //echo $variable = $_GET['subid'];
  echo $variable = "<script>document.write(subid)</script>";
?>
								  <?php
								  
								  //print_r($result['items']);
								    $i = 0;
									 foreach ($result['category'] as $k => $category_data)
											  {
													echo	$menid =  $category_data->menuid;  
											  }
									
									
								    foreach ($result['items'] as $key => $item_data)
										{
											$display = ($key == 1 || $key == 7) ? 'block' : 'none';
											$i++;
											echo "<div id='menucontainer".$key."' class='row menucontainer' style='display:$display'>";
											foreach ($item_data as $item_result)
												{   
												    $vgnonvg = ($item_result->item_type == 1) ? 'vg' : 'nonvg';
													echo '<div class="row" style="margin:5px;">
															<div class="row">
															  <div class="col-md-1"><i class="'.$vgnonvg.'">&nbsp;</i></div>
															  <div class="col-md-7" style="font-size:15px;color:#293F54">'.ucwords($item_result->item_name).'</div>
															  <div class="col-md-2">Rs. '.$item_result->price.' /-</div>
															  <div class="col-md-2"><a href="'.base_url().'index.php/establishmentdata/edit/'.$item_result->{'menu_id'}.'/'.$this->uri->segment(3).'"><button class="btn btn-primary"><i class="fa fa-edit"></i> </button></a>&nbsp;&nbsp;<a href="'.base_url().'index.php/establishmentdata/view/del/'.$item_result->{'menu_id'}.'" onclick="return confirm(\'Are you sure ?\')"><button class="btn btn-danger"><i class="fa fa-trash"></i> </button></a></div>
															</div>
															<div class="hr-line-dashed"></div>
														  </div>';
												}
												 echo "</div>";
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
			var subid = id;
			//alert(subid);
				
				
			}

	</script>
	<script>
		function branchStaff(value)
			{
				 var userid=value;
				location.href = "<?php echo base_url(); ?>index.php/establishmentdata/menu/" + value;
				
				
				
			}
    </script>
</body>

</html>
			