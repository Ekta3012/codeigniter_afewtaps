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
.switchery{background-color:#ed5565 !important }
</style>
</head>
<body>

    <div id="wrapper">
       <?php $this->load->view('include/inc_navigation'); ?>
      <div id="page-wrapper" class="gray-bg sidebar-content">
       <div class="row border-bottom">
	   <?php $this->load->view('include/inc_topnav'); ?>
       </div>
	   
		
      <div class="wrapper wrapper-content" id="leftWrapper" style="padding-right:0">
            <div class="row">
                 <!-- Table -->
				     <div class="col-lg-12">
							<div class="ibox float-e-margins">
                              <div class="bar brdrad5" style="border-bottom-left-radius:0;border-bottom-right-radius:0;margin-bottom:20px">Establishments Registered</div>
                            
							
								<div class="ibox-content">

							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
								<tr>
									<th>S No</th>
									<th>Name</th>
                                    <th>Establishment</th>
                                  
                                    <th>Total No. of Orders</th>
                                    <th>Employee ID</th>
                                    <th>Mobile No.</th>
									<th>Address</th>
									<th>Email</th>
                                    <th>Action</th>
								</tr>
								</thead>
								<tbody>
								
								<?php
								//print_r($establishment);
								
								   if (count($establishment) > 0)
									   {
										   $i = 0;
										   foreach ($establishment as $data)
											   {
												   $i++;
												   
												   $total_order = $this->db->select('COUNT(*) as count')->get_where($this->db->dbprefix('order'), array('establishment_id' => $data->eid))->row();
												   
												   echo '<tr class="">
												            <td>'.$i.'</td>
															<td>'.$data->{'primary_contact_name'}.'</td>
															<td>'.$data->{'estab_name'}.'</td>
															<td>'.$total_order->{'count'}.'</td>
															<td>'.$data->{'estab_id'}.'</td>
															<td class="center">'.($data->{'phoneno'} != '' ? $data->{'phoneno'} : '-------------------------').'</td>
															<td>'.$data->{'address'}.'</td>
															<td>'.$data->{'email'}.'</td>
															<td class="text-center"><a title="Delete" id="'.$data->{'user_id'}.'" href="'.base_url().'index.php/establishment/delestab/'.$data->{'user_id'}.'" onclick="return confirm(\'Are you sure! You want to delete this entries?\')"><img src="'.config_item('base_url').'assets/img/delete.png"></a>
															</td>
														 </tr>';
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
			