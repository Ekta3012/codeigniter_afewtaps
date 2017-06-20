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
.col-sm-3.control-label.qty > span {
  border: 1px solid #000;
  border-radius: 50px;
  padding: 0 6px;
}
.items { border-bottom: 1px solid #e9e9e9;
padding-bottom: 10px; }
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

.nonvg{background:url('../../../assets/img/red_icon.png');background-repeat:no-repeat;width:20px;height:20px;  display: inline-block;background-position:center center}
.vg{background:url('../../../assets/img/green_icon.png');background-repeat:no-repeat;width:20px;height:20px;  display: inline-block;background-position:center center}


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
	   
        <div class="wrapper wrapper-content" id="leftWrapper"  style="padding-right:0">
            <div class="row">
                 <!-- Table -->
				     <div class="col-lg-12">
							<div class="ibox float-e-margins">	
							 <div class="bar brdrad5" style="borderdta-bottom-left-radius:0;borderdta-bottom-right-radius:0;">Locality Information</div>
							
								<div class="ibox-content">
								 <?php


														
													echo form_open('', array('class' => 'form-horizontal')); 
														 
								
								//print_r($orderhistory['orders']);
								   if (count ($orderhistory['orders']) > 0)
									  {
										 foreach ($orderhistory['orders'] as $ordata)
											   { }
									echo  '<div class="form-group">
								    <div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">Order Id</label><div class="col-sm-6">'; echo $ordata->{'order_id'}; echo'</div>
									</div>
								</div>';
								echo  '<div class="form-group">
								    <div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">Item(s):</label></div><div class="col-sm-12">';
								foreach ($orderhistory['orders'] as $ordata)
											   { 
											   $vgnonvg = ($ordata->item_type == 1) ? 'vg' : 'nonvg';
											   echo '<div class="col-sm-12 items">
											
											   <span class="col-sm-5 control-label"> <h4><i class="'.$vgnonvg.'">&nbsp;</i>'.$ordata->{'item_name'}.'</h4>';
											   echo '<span>'.$ordata->{'price'}.'</span></span>';
											     echo '<span class="col-sm-3 control-label qty"><span>'.$ordata->{'qty'}.'</span></span></span></div>';
												 $total = $total + $ordata->{'price'};
												 
											   }
											   echo '
									
								</div>';
								
									echo  '<div class="form-group">
								    <div class="col-sm-12 text-center heght30">
									   <label class="col-sm-4 control-label">Total Amount</label><div class="col-sm-6">'; echo $total; echo'</div>
									</div>
								</div>';
									  }
									  
									  
								 else
										 {
											 echo "<br /><h2>Sorry, No Order Found !</h2>";
										 }
                                     
									   
										 echo form_close();
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
	
	
	
</body>

</html>
			