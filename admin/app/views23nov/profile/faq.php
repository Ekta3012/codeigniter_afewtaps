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

<style>
.row.text-center {
  margin-bottom: 20px;
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
							  <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;">FAQ's</div>
							
								<div class="ibox-content">
                                 
                                  
								
								<?php

										 $segment = (int) $this->uri->segment(3);
									 switch ($segment)
										 {
											 case 0: 
											 case 1:
											            $establishment_active       = 'active';
														break;
											 case 2:
														$userapp_active  = 'active';
														break;
											 case 3:
											            $serviceapp_active    = 'active';
														break;
										 }
										
										
										
										?>
                                    <div class="row text-center">
									  <div class="col-md-1 text-center"></div>
									  <div class="col-md-3 text-center">
									     <a href="<?php echo base_url(); ?>index.php/profile/faq/1"><button class="btn btn-w-m <?php echo isset($establishment_active) ? $establishment_active : "nonactive" ; ?>" data-attr="1" type="button">Establishment</button></a>
									 </div>
									  <div class="col-md-3 text-center">
									   <a href="<?php echo base_url(); ?>index.php/profile/faq/2"><button class="btn btn-w-m <?php echo isset($userapp_active) ? $userapp_active : "nonactive" ; ?>" data-attr="2" type="button">User App</button></a>
									  </div>
									  <div class="col-md-3 text-center">
									    <a href="<?php echo base_url(); ?>index.php/profile/faq/3"><button class="btn btn-w-m <?php echo isset($serviceapp_active) ? $serviceapp_active : "nonactive" ; ?>" data-attr="3" type="button">Service App</button></a>
									  </div>
									  <div class="col-md-2 text-center"></div>
								    </div>
											 	
								

							<?php	 
						 if($segment=='1' || $segment=='0')
                                    {
										
									   if (count($result['estab']) > 0)
									   {
										   $i = 0;
										  // print_r($result['estab']);
										   foreach ($result['estab'] as $establish)
											   {
												     foreach ($establish as $data)
											   {
												   $i++;
												   
												   						echo ' <div class="row"><div class="col-md-10">';
										 echo '<p style="background-color: rgb(238, 238, 238);font-size: 14px;font-weight: bold;
    padding: 9px 11px;">Q'.$i. '. '.$data->{'que'}.'</p>';
										 echo '<p style="text-align:justify;">'.$data->{'ans'}.'</p>';
												
											echo ' </div>';	   
															
							
                            echo ' <div class="col-md-2">';
                           echo '<a style="  border-right: 1px solid #ccc;
    padding-right: 7px;" title="Edit" href="'.base_url().'index.php/profile/addfaq/'.$data->{'id'}.'/1"><img src="'.config_item('base_url').'assets/img/edit.png"></a>&nbsp;&nbsp;<a title="Delete" href="'.base_url().'index.php/profile/delfaq/'.$data->{'id'}.'" onclick="return confirm(\'Are you sure! You want to Delete this entries ?\')"><img src="'.config_item('base_url').'assets/img/delete.png"></a>';
                             echo ' </div></div>';
												   
												   
											   }
											   }
											   
									   }
										
									}
									
									/*for user app faq*/
									 if($segment=='2')
                                    {
										
									   if (count($result['user']) > 0)
									   {
										   $i = 0;
										  // print_r($result['estab']);
										   foreach ($result['user'] as $user)
											   {
												     foreach ($user as $data)
											   {
												   $i++;
												   
												   						echo ' <div class="row"><div class="col-md-10">';
										 echo '<p style="   background-color: rgb(238, 238, 238);
    font-size: 14px;
    font-weight: bold;
    padding: 9px 11px;">Q'.$i. '. '.$data->{'que'}.'</p>';
										 echo '<p style="text-align:justify;">'.$data->{'ans'}.'</p>';
												
											echo ' </div>';	   
															
							
                            echo ' <div class="col-md-2">';
                           echo '<a style="  border-right: 1px solid #ccc;
    padding-right: 7px;" title="Edit" href="'.base_url().'index.php/profile/addfaq/'.$data->{'id'}.'/2"><button class="btn btn-primary"><i class="fa fa-edit"></i> </button></a>&nbsp;&nbsp;<a title="Delete" href="'.base_url().'index.php/profile/delfaq/'.$data->{'id'}.'" onclick="return confirm(\'Are you sure! You want to Delete this entries ?\')"><button class="btn btn-danger"><i class="fa fa-trash"></i> </button></a>';
                             echo ' </div></div>';
												   
												   
											   }
											   }
											   
									   }
										
									}
									
									
									/*for service app faq*/
									 if($segment=='3')
                                    {
										
									   if (count($result['service']) > 0)
									   {
										   $i = 0;
										  // print_r($result['estab']);
										   foreach ($result['service'] as $service)
											   {
												     foreach ($service as $data)
											   {
												   $i++;
												   
												   echo ' <div class="row"><div class="col-md-10">';
												   echo '<p style="   background-color: rgb(238, 238, 238);font-size: 14px;font-weight: bold;padding: 9px 11px;">Q'.$i. '. '.$data->{'que'}.'</p>';
												   echo '<p style="text-align:justify;">'.$data->{'ans'}.'</p>';
														
												   echo ' </div>';	   
															
							
                            echo ' <div class="col-md-2">';
                           echo '<a style="  border-right: 1px solid #ccc;
    padding-right: 7px;" title="Edit" href="'.base_url().'index.php/profile/addfaq/'.$data->{'id'}.'/3"><button class="btn btn-primary"><i class="fa fa-edit"></i> </button></a>&nbsp;&nbsp;<a title="Delete" href="'.base_url().'index.php/profile/delfaq/'.$data->{'id'}.'" onclick="return confirm(\'Are you sure! You want to Delete this entries ?\')"><button class="btn btn-danger"><i class="fa fa-trash"></i> </button></a>';
                             echo ' </div></div>';
												   
												   
											   }
											   }
											   
									   }
										
									}
								  ?>			
								  
								  <div class="row" style="height:40px"></div>
								 
								
								</div>
								
								
								  
							  <div class="row">
								<div class="col-md-10 text-right">
								   <a href="<?php echo base_url(); ?>index.php/profile/addfaq"><button class="addMenu btn btn-w-m" data-attr="1" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add More FAQ</button></a>
								</div>
								
								<div class="col-md-2"></div>
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
				
				
			}

	</script>
	
</body>

</html>
			