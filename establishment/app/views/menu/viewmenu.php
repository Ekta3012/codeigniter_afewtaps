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

.vg{background:url('../../assets/img/green_icon.png');background-repeat:no-repeat;width:20px;height:20px;float:left;background-position:center right}
.nonvg{background:url('../../assets/img/red_icon.png');background-repeat:no-repeat;width:20px;height:20px;float:left;background-position:center right}
.drnk{background:url('../../../assets/img/black_icon.png');background-repeat:no-repeat;width:20px;height:20px;float:left;background-position:center right}


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
							  <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">View Menu Items</div>
							
								<div class="ibox-content">
								
								  <div class="row"><a href="<?php echo base_url(); ?>index.php/menu/index"><button class="addMenu btn btn-w-m" data-attr="1" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Menu Items</button></a></div>
								  
								  <div class="row"></div>
								  
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
									  <a href="<?php echo base_url(); ?>index.php/menu/view/1"><button class="btn btn-w-m <?php echo isset($food_active) ? $food_active : "nonactive" ; ?>" data-attr="1" type="button">Food</button></a>
									  <a href="<?php echo base_url(); ?>index.php/menu/view/2"><button class="btn btn-w-m <?php echo isset($beverages_active) ? $beverages_active : "nonactive" ; ?>" data-attr="2" type="button">Beverages</button></a>
									  <!--<a href="<?php echo base_url(); ?>index.php/menu/view/3"><button class="btn btn-w-m <?php echo isset($dessert_active) ? $dessert_active : "nonactive" ; ?>" data-attr="3" type="button">Dessert</button></a>-->

								  </div>
								 	
								<?php

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
								    $i = 0;
								    foreach ($result['items'] as $key => $item_data)
										{
											$display = ($i == 0) ? 'block' : 'none';
											$i++;
											echo "<div id='menucontainer".$key."' class='row menucontainer' style='display:$display'>";
											
											foreach ($item_data as $item_result)
												{   
												    $vgnonvgdrnk = ($item_result->item_type == 1) ? 'vg' : (($item_result->item_type == 2) ? 'nonvg' : 'drnk');
													$customization = checkCustomization($item_result->menu_id);
													
													echo '<div class="row" style="margin:5px;border-bottom:1px solid #eee">
															<div class="row">
															  <div class="col-md-1 text-right '.$vgnonvgdrnk.'">&nbsp;</div>
															  <div class="col-md-7" style="font-size:15px;color:#293F54">'.ucwords($item_result->item_name).'<br /><span style="font-size:11px;color:#aaa">'.$customization.'</span></div>
															  <div class="col-md-2">Rs. '.$item_result->price.' /-</div><div class="col-md-2"><a href="'.base_url().'index.php/menu/edit/'.$item_result->{'menu_id'}.'"><button class="btn btn-primary"><i class="fa fa-edit"></i> </button></a>&nbsp;&nbsp;<a href="'.base_url().'index.php/menu/del/'.$item_result->{'menu_id'}.'" onclick="return confirm(\'Are you sure ?\')"><button class="btn btn-danger"><i class="fa fa-trash"></i> </button></a></div>
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
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Menu'},
                    {extend: 'pdf', title: 'Menu'},

                    {extend: 'print',
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
        });
		
		
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
			