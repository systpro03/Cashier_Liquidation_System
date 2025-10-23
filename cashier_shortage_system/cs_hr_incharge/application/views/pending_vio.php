<html lang="en" class="no-js"><!--<![endif]--><!-- BEGIN HEAD --><head>
<meta charset="utf-8">
<title>Metronic | Metronic | Admin Dashboard Template</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport">
<meta content="" name="description">
<meta content="" name="author">
<!-- BEGIN GLOBAL MANDATORY STYLES -->




<link href="<?php echo base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/clockface/css/clockface.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url();?>assets/global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/global/css/plugins-md.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
<link href="<?php echo base_url();?>assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet">
<!-- END THEME STYLES -->


<style type="text/css">

.ui-state-focus 
{
	background: none !important;
	background-color: blue !important;
	border: none !important;
	color: white !important;
}

table.display tbody tr:nth-child(even):hover td
{
background-color: #333; !important;
color: white;
}

  table.display tbody tr:nth-child(even):hover td
  {
  background-color: #333 !important;
  color: white;
  }

  table.display tbody tr:nth-child(odd):hover td 
  {
  background-color: #333 !important;
  color: white;
  }

  table.display tbody tr:nth-child(even):hover td .spn
  {
  background-color: #333 !important;
  color: red;
  }

  table.display tbody tr:nth-child(odd):hover td .spn
  {
  background-color: #333 !important;
  color: red;
  }




td
{ 
	font-size: 12px; 
}

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
				<!-- <a href="index.html"><img src="<?php echo base_url()?>assets/admin/layout3/img/header.png" alt="logo" class="logo-default" style="margin-top: 15px;" ></a> -->
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
		<div class="container" style="background:; width: 95%; padding: 0px !important;">		
			
			<div class="row">
				<div class="col-md-3">
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet light" style="padding-bottom: 0px !important;">
						<div class="portlet-title">
							<div class="caption">								
								<span class="caption-subject uppercase" style="color: black !important; font-size: 18px;">pending violation Form</span>
							</div>					
						</div>
						<div class="portlet-body form">
							<form role="form">
								<div class="form-body">
							<div class="form-group" style="padding-left: 0px; padding-right: 5px;">
										<label>Department : </label>
										<select class="form-control" id="dept" name="dept">
											<?php foreach ($department as $key => $value) 
											{
												?>
													<option value="<?php echo $value['dcode']?>"><?php echo $value['dept_name']?></option>		
												<?php
											} ?>										
										</select> 						
									</div>
									<div class="form-group">
										<label>Date From : </label>
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-calendar"></i>
											</span>
											<input type="text" class="form-control date-picker" id="cut_off_date_from">											
											<input type="hidden" class="form-control col-md-2 col-xs-12" id="hide_cut_off_date_from">
										</div>
									</div>	
									<div class="form-group">
										<label>Date To : </label>
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-calendar"></i>
											</span>
											<input type="text" class="form-control date-picker" id="cut_off_date_to">													
											<input type="hidden" class="form-control col-md-2 col-xs-12" id="hide_cut_off_date_to">
										</div>
									</div>			
								</div>
								<div class="form-actions">
									<button type="button" id="gen_accounting_btn" class="btn btn-success pull-right">Generate Violation</button>								
								</div>
							</form>
						</div>
					</div>
			
					<!-- END SAMPLE FORM PORTLET-->
				</div>
				<div class="col-md-9 col-sm-12">
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet light" style="">
						<div class="portlet-title">
							<div class="caption">								
								<span class="caption-subject uppercase" style="color: black !important; font-size: 18px;">pending Violation data table</span>
							</div>

						</div>				
					
				
					<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-condensed display" id="accounting_table">
						<thead>
							<tr>
								<th scope="col" width="2%">
									<center>EMP. ID
								</th>
								<th scope="col" width="2%">
									<center>EMPLOYEE NAME
								</th>								
								<th scope="col" width="1%">
									<center>DEPARTMENT
								</th>							
								<th scope="col" width="1%">
									<center>AMOUNT
								</th>						
								<th scope="col" width="2%">
									<center>TYPE
								</th>	
								<th scope="col" width="2%">
									<center>DATE
								</th>					
							</tr>
						</thead>				
					</table>
					</div>								
				</div>			
			</div>
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

<script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url();?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!-- END PAGE LEVEL SCRIPTS -->


<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/table-advanced.js"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/components-pickers.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
jQuery(document).ready(function() {       
// initiate layout and plugins
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
ComponentsPickers.init();
});   
</script>


<script type="text/javascript">

var accounting_table; 

$(document).ready(function(){
	$('#submit_accounting_btn').prop('disabled', true);
});

 $( function() 
 {
	$("#cut_off_date_from" ).datepicker({});
 });

 $( function() 
 {
	$("#cut_off_date_to" ).datepicker({});
 });

$(document).ready(function() 
{
  accounting_table = $("#accounting_table").DataTable({  	
  	 'ordering' : false,   
  }); 
});


$('#gen_accounting_btn').click(function()
{  
	 var date_from = document.getElementById('cut_off_date_from').value;  
	 var date_to   = document.getElementById('cut_off_date_to').value;  
	 var dcode     = document.getElementById('dept').value;  

	if(date_from == "" || date_to == "")
	{
		$('#error_date').modal('show');   
	}
	else
	{
		$.ajax(
		{
			url: "<?php echo site_url('main_controller/pending_violation');?>",
			method:"POST",
			data:{date_from:date_from, date_to:date_to, dcode:dcode},
			success:function(data)
			{  				
				var data = $.parseJSON(data);               
			
				accounting_table = $('#accounting_table').DataTable({destroy:true,data:data.data,
				'ordering' : false,   
				"columnDefs":[                      
				{ className: "text-right", "targets": [3] },
				{ className: "text-center", "targets": [0, 2, 4, 5] }          
				],
				"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) 
				{
					if ( aData[4] == "S" )
					{
						$('td', nRow).css('background-color', '#ffa9a9');
					}
					else
					{
						$('td', nRow).css('background-color', '#CCFF99');
					}
				}
			                              
				});
					
			} 
		});
	}
});


</script>



<div class="modal fade" id="emp_charge_breakdown_modal" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Charge's Breakdown Dialog</h4>
			</div>
			<div class="modal-body" id="emp_div_breakdown">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal"><span class="md-click-circle md-click-animate" style="height: 65px; width: 65px; top: -9.5px; left: -10.4844px;"></span>Close</button>				
			</div>
		</div>
	<!-- /.modal-content -->
	</div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="error_date" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Empty Field(s) Dialog</h4>
			</div>
			<div class="modal-body">
				Please select cut - off date.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal"><span class="md-click-circle md-click-animate" style="height: 65px; width: 65px; top: -14.5px; left: 1.51563px;"></span>Close</button>
				
			</div>
		</div>
	<!-- /.modal-content -->
	</div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="empty" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Empty Dialog</h4>
			</div>
			<div class="modal-body">
				No cashier charge's available for the selected cut - off.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal"><span class="md-click-circle md-click-animate" style="height: 65px; width: 65px; top: -14.5px; left: 1.51563px;"></span>Close</button>
				
			</div>
		</div>
	<!-- /.modal-content -->
	</div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="confirm_sub_modal" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Confirmation Dialog</h4>
			</div>
			<div class="modal-body">
				You are about to submit employee(s) charge to accounting. Do you want to continue?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal"><span class="md-click-circle md-click-animate" style="height: 65px; width: 65px; top: -14.5px; left: 1.51563px;"></span>Close</button>
				<button type="button" class="btn btn-success" id="confirm_sub_btn">Continue</button>
			</div>
		</div>
	<!-- /.modal-content -->
	</div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="success_modal" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Success Dialog</h4>
			</div>
			<div class="modal-body">
				Employee charges successfully submitted.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal"><span class="md-click-circle md-click-animate" style="height: 65px; width: 65px; top: -14.5px; left: 1.51563px;"></span>Close</button>
				
			</div>
		</div>
	<!-- /.modal-content -->
	</div>
<!-- /.modal-dialog -->
</div>