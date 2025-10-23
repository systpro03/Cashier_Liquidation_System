<html lang="en" class="no-js"><!--<![endif]--><!-- BEGIN HEAD -->


<head>
<meta charset="utf-8"/>
<title>Metronic | Portfolio</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"> -->
<link href="<?php echo base_url()?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url()?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url()?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url()?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url()?>assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/admin/pages/css/portfolio.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url()?>assets/global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css">
<link href="<?php echo base_url()?>assets/global/css/plugins-md.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url()?>assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url()?>assets/admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
<link href="<?php echo base_url()?>assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css">
<!-- END THEME STYLES -->
<!-- <link rel="shortcut icon" href="favicon.ico"/> -->

<style type="text/css">
/*	img.center {
    display: block;
    margin: 0 auto;
}*/
</style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body class="page-md" >
<!-- BEGIN HEADER -->
<div class="page-header">
	<!-- BEGIN HEADER TOP -->
	<div class="page-header-top">
		<div class="container" style="margin-left: 25px; width: 97%; margin-right: 25px;">
			<!-- BEGIN LOGO -->
			<div class="page-logo" style="">
				<!-- <a href="index.html"><img src="<?php echo base_url()?>assets/admin/layout3/img/sample.png" alt="logo" class="logo-default" style="margin-top: 15px;" ></a> -->
			</div>
			<!-- END LOGO -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<a href="javascript:;" class="menu-toggler"></a>
			<!-- END RESPONSIVE MENU TOGGLER -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown dropdown-user dropdown-dark">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<img alt="" class="img-circle" src="http://<?php echo $photo_url;?>">
						<span class="username username-hide-mobile">Hi <?php echo $firstname;?> <i class="fa fa-angle-down"></i></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								<a href="extra_profile.html">
								<i class="icon-user"></i> My Profile </a>
							</li>
							<li>
								<a href="page_calendar.html">
								<i class="icon-calendar"></i> My Calendar </a>
							</li>
							<li>
								<a href="inbox.html">
								<i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger">
								3 </span>
								</a>
							</li>
							<li>
								<a href="javascript:;">
								<i class="icon-rocket"></i> My Tasks <span class="badge badge-success">
								7 </span>
								</a>
							</li>
							<li class="divider">
							</li>
							<li>
								<a href="extra_lock.html">
								<i class="icon-lock"></i> Lock Screen </a>
							</li>
							<li>
								<a href="<?php echo site_url('main_controller/log_out')?>">
								<i class="icon-key"></i> Back to Homepage </a>
							</li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
	</div>
	<!-- END HEADER TOP -->
	<!-- BEGIN HEADER MENU -->
	<?php
		$this->load->view('header');
	?>
	<!-- END HEADER MENU -->
</div>
<!-- END HEADER -->
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container" style="padding: 0px !important">
	<!-- BEGIN PAGE HEAD -->
	
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE CONTENT -->
	</br>
	<div class="page-content">
		<div class="container" style="background:; width: 95%; padding: 0px !important; height: 60%;">		
			
		<div class="row">
			<div class="col-md-6">
							<div class="tab-content">
								<div id="tab_1" class="tab-pane active">
									<div id="accordion1" class="panel-group">
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1">
												REMINDERS</a>
												</h4>
											</div>
											<div id="accordion1_1" class="panel-collapse collapse in">
												<div class="panel-body">
													<div class="panel panel-success">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1">
															To all Supervisor / Section Head</a>
															</h4>
														</div>
														<div id="accordion1_1" class="panel-collapse collapse in">
															<div class="panel-body">
																Each department must confirm cashier's shortage and overage record for VMS<i>(Violation Monitoring System)</i>. Each DTR cut off date has it's corresponding deadline of submission or confirmation of cashier's shortage and overage.
															</div>
														</div>
													</div>
													<div class="panel panel-warning">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1">
															For cut off's 9 to 23</a>
															</h4>
														</div>
														<div id="accordion1_1" class="panel-collapse collapse in">
															<div class="panel-body">
																Deadline of submission of cashier's shortage and overages misconduct record for VMS  - <strong>EVERY 2nd DAY OF THE MONTH.</strong>
															</div>
														</div>
													</div>
													<div class="panel panel-danger">
														<div class="panel-heading">
															<h4 class="panel-title">
															<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1">
															For cut off's 24 to 8</a>
															</h4>
														</div>
														<div id="accordion1_1" class="panel-collapse collapse in">
															<div class="panel-body">
																Deadline of submission of cashier's shortage and overages misconduct record for VMS  - <strong>EVERY 17th DAY OF THE MONTH.</strong>
															</div>
														</div>
													</div>
												</div>

											</div>
										</div>							
							</div>
						</div>			
				</div>
			<!-- END PAGE CONTENT INNER -->
			</div>
			<div class="col-md-6">
							<div class="tab-content">
								<div id="tab_1" class="tab-pane active">
									<div id="accordion1" class="panel-group">
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1">
												DEMO</a>
												</h4>
											</div>
											<div id="accordion1_1" class="panel-collapse collapse in">
												<div class="panel-body" style="padding: 5px;">
															<div class="margin-top-10">						
									<div class="row mix-grid">										
										<div class="col-md-12 col-sm-12 mix category_1">
											<div class="mix-inner">
												<img class="img-responsive" src="<?php echo base_url()?>/image/demo2.gif?>" alt="">
												<div class="mix-details">
													<h4>VIEW FULL SIZE</h4>													
													<a class="mix-preview fancybox-button" href="<?php echo base_url()?>/image/demo2.gif?>" title="DEMO" data-rel="fancybox-button" style="display: block; margin: 0 auto; left: 200px; right: 200px;">
													<i class="fa fa-play"></i>
													</a>
												</div>
											</div>
										</div>
								
									</div>
								</div>
												</div>

											</div>
										</div>							
							</div>
						</div>			
				</div>
			<!-- END PAGE CONTENT INNER -->
			</div>	
	
		</div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->
<!-- BEGIN PRE-FOOTER -->

<!-- END PRE-FOOTER -->
<!-- BEGIN FOOTER -->
<!-- <div class="page-footer">
	<div class="container" style=" text-align: right;">
		 2018 © AGC. All Rights Reserved.
	</div>
</div> -->
<div class="scroll-to-top" style="display: none;">
	<i class="icon-arrow-up"></i>
</div>

<script src="<?php echo base_url()?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url()?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/jquery-mixitup/jquery.mixitup.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url()?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/pages/scripts/portfolio.js"></script>
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
   Portfolio.init();
});
</script>

