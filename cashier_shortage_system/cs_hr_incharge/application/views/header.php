	<!-- BEGIN HEADER MENU -->
	<div class="page-header-menu" style="display: block;">
		<div class="container" style="margin-left: 5px;">
			
			<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
			<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
			<div class="hor-menu ">
				<ul class="nav navbar-nav">							
					<li class="menu-dropdown classic-menu-dropdown ">
						<a href="<?php echo site_url('main_controller')?>">
						Dashboard
						</a>					
					</li>
					<li class="menu-dropdown classic-menu-dropdown ">
						<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;">
						Employee Violation <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu pull-left">
							<li>
								<a href="<?php echo site_url('main_controller/pending_con');?>">
								<i class="icon-docs"></i>
								&nbsp;Pending Violation </a>								
							</li>	
							<li>
								<a href="<?php echo site_url('main_controller/forwarded_con');?>">
								<i class="icon-docs"></i>
								&nbsp;Violation Forwarded </a>								
							</li>					
						</ul>
					</li>				
					<li class="menu-dropdown">
						<a href="angularjs" target="_blank" class="tooltips" data-container="body" data-placement="bottom" data-html="true" data-original-title="AngularJS version demo">
						CS HR Version 1.1 </a>
					</li>
				</ul>
			</div>
			<!-- END MEGA MENU -->
		</div>
	</div>
	<!-- END HEADER MENU -->