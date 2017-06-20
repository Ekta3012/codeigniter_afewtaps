<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
	</div>
	
	<ul class="nav navbar-top-links navbar-right">
	  <?php
	    $Ename =  $this->session->userdata('ename');
    	if ($Ename != '')
		echo '<li><span class="m-r-sm text-muted welcome-message"><strong>Welcome '.$Ename.' Dashboard</strong></span></li>';
     ?>
				
	  <li><a href="<?php echo site_url(); ?>/profile/logout" title="Log out"><i class="fa fa-sign-out"></i> Log out</a></li>
	</ul>
</nav>