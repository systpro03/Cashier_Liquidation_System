<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.2.0
Version: 3.4
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest (the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
  <meta charset="utf-8">
  <title>CS LIQUIDATION</title>

  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta content="Metronic Shop UI description" name="description">
  <meta content="Metronic Shop UI keywords" name="keywords">
  <meta content="keenthemes" name="author">

  <meta property="og:site_name" content="-CUSTOMER VALUE-">
  <meta property="og:title" content="-CUSTOMER VALUE-">
  <meta property="og:description" content="-CUSTOMER VALUE-">
  <meta property="og:type" content="website">
  <meta property="og:image" content="-CUSTOMER VALUE-"><!-- link to image for socio -->
  <meta property="og:url" content="-CUSTOMER VALUE-">

  <link rel="shortcut icon" href="favicon.ico">

  <!-- Fonts START -->
  <link href="<?php echo base_url();?>assets/admin.css" rel="stylesheet" type="text/css">
  <!-- Fonts END -->

  <!-- Global styles START -->          
  <link href="<?php echo base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Global styles END --> 
   
  <!-- Page level plugin styles START -->
  <link href="<?php echo base_url();?>assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
  <!-- Page level plugin styles END -->

  <!-- BEGIN PAGE LEVEL STYLES -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/select2/select2.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
  <!-- END PAGE LEVEL STYLES -->

  <link href="<?php echo base_url()?>assets/toggle/css/bootstrap-toggle.min.css" rel="stylesheet">

  <!-- Theme styles START -->
  <link href="<?php echo base_url();?>assets/global/css/components.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/frontend/layout/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/frontend/pages/css/portfolio.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/frontend/layout/css/style-responsive.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/frontend/layout/css/themes/red.css" rel="stylesheet" id="style-color">
  <link href="<?php echo base_url();?>assets/frontend/layout/css/custom.css" rel="stylesheet">
  <!-- Theme styles END -->

  <!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/clockface/css/clockface.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/css/datepicker3.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
<!-- END PAGE LEVEL STYLES -->

  <link href="<?php echo base_url();?>assets/global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url();?>assets/global/css/plugins-md.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url();?>assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url();?>assets/admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
  <link href="<?php echo base_url();?>assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet">


<style type="text/css">
table.dataTable td.dataTables_empty 
{
  text-align: center;    
}

.wrapper {
    overflow: auto;
    height: 500px;
    /*width: 50%;*/

    /*border: 1px solid red;*/
}
.content 
{
    overflow-y: auto;
}


table.display tbody tr:nth-child(even):hover td
{
  color: black !important;
  background-color: #ff5722 !important;
}

table.display tbody tr:nth-child(even):hover td
{
  color: black !important;
  background-color: #ff5722 !important;
}

table.display tbody tr:nth-child(odd):hover td 
{
  color: black !important;
  background-color: #ff5722 !important;
}

/*  table.display tbody tr:nth-child(even):hover td .spn
  {
  background-color: #ff5722 !important;
  color: black;
  }

  table.display tbody tr:nth-child(odd):hover td .spn
  {
  background-color: #ff5722 !important;
  color: black;
  }*/

    input
    {
        display: none;
    }

    label input[type=checkbox] ~ span 
    {
      display: inline-block;
      vertical-align: middle;
      cursor: pointer;
      background: #fff;
      border: 1px solid #888;
      padding: 1px;
      height: 20px;
      width: 20px;
    }

    label input[type=checkbox]:checked ~ span 
    { 
      background: url('<?php echo base_url();?>assets/image/check.png');
      background-size: 100%;
    }
</style>
</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="corporate">
    <!-- BEGIN STYLE CUSTOMIZER -->
    
    <!-- END BEGIN STYLE CUSTOMIZER --> 

    <?php
      $this->load->view('header');
    ?>

        <div class="page-container">

  <!-- END PAGE HEAD -->
  <!-- BEGIN PAGE CONTENT -->
  <div class="page-content" style="background: #ffffff;">
    <div class="container">
      <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
     
      <!-- /.modal -->
      <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
      <!-- BEGIN PAGE BREADCRUMB -->

      <!-- END PAGE BREADCRUMB -->
      <!-- BEGIN PAGE CONTENT INNER -->
      <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
     
      <!-- /.modal -->
      <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
      <!-- BEGIN PAGE BREADCRUMB -->

      <!-- END PAGE BREADCRUMB -->
      <!-- BEGIN PAGE CONTENT INNER -->
      <div class="row">
        <div class="col-md-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
       <div class="portlet light">
            <div class="portlet-title">
              <div class="caption">
                <span class="caption-subject uppercase">DENOMINATION FORM <small style="color: red; font-weight:;"> ( Please skip borrow fields. ) </small></span>
                    <input type="hidden" id="dept_code" class="form-control" value="<?php echo $dept;?>">
              </div>
            </div>
            <div class="portlet-body">
                <div class="form-body" id="form_body">               
                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-hover display" style="color: black; font-size: 12px;">
                            <thead>
                                <tr>                  
                                    <th>
                                        <center>EMPLOYEE NAME
                                    </th>
                                    <th width="15%">
                                        <center>DEPARTMENT
                                    </th>
                                    <th width="15%">
                                        <center>DENOMINATION AMT.
                                    </th>
                                    <th width="15%">
                                        <center>SHORT/OVER AMT.
                                    </th>
                                    <th width="8%">
                                        <center>TYPE
                                    </th>
                                    <th width="10%">
                                     <center>DATE
                                    </th>
                                    <th width="15%">
                                        <center>BORROW
                                    </th>           
                                </tr>
                            </thead>
                            <form name="add_name" id="add_name">
                                <tbody>
                                    <tr>
                                        <input type='hidden' class="form-control emp_id" id="emp_id_1" name="emp_id[]"  placeholder="Employee Name"/ style="font-size: 12px;">
                                        <td style="background: ;">
                                            <input type='text' class="form-control input-sm name" id="name_1" name="names[]"  placeholder="Employee Name"/ style="font-size: 12px;">
                                        </td>
                                        <td style="background: ;">
                                            <input name="dept[]" type='text' class="form-control input-sm dept"   id='dept_1' readonly style="font-size: 12px;">
                                        </td>
                                        <td style="background: ;">
                                            <input type='text' min="0"  class="form-control input-sm den_total" name="den_total[]" id='den_total_1' placeholder="0.00" style="text-align: right; font-size: 12px;">
                                        </td>
                                        <td style="background: ;">
                                            <input type='text' min="0"  class="form-control input-sm amount" name="amount[]" id='amount_1' placeholder="0.00" style="text-align: right; font-size: 12px;">
                                        </td>
                                        <td style="background: ;">
                                            <select class="form-control input-sm type" name="type[]" id="type_1">                          
                                                <option>S</option>
                                                <option>O</option>
                                                <option>PF</option>                           
                                            </select>
                                        </td>      
                                        <td style="background: ;">
                                            <input type='text'  class="form-control input-sm date-picker date" name="date[]"   id='date_1' value="<?php echo date("m/d/Y");?>" style="font-size: 12px; text-align: right;">
                                        </td> 
                                        <td style="background: ;">
                                            <div style="background: red; padding: 0px;" class="col-md-8">                                                
                                                <input type='text'  class="form-control input-sm input_br" name="input_br[]" id='input_br_1' readonly style="font-size: 12px;">
                                                <input type='hidden'  class="form-control input-sm hidden_input_br" name="hidden_input_br[]" id='hidden_input_br_1' style="font-size: 12px;">
                                            </div>
                                            <div style="background:; padding-left: 10px; padding-right: 0px; padding-top: 3px;" class="col-md-4">  
                                                <a id="br_del_btn_1" onClick="showDiv(1);" class="btn btn-xs red"><i class="fa fa-remove"></i></a>
                                            </div>
                                        </td>                                    
                                    </tr> 
                                    <tr>
                                        <input type='hidden' class="form-control emp_id" id="emp_id_2" name="emp_id[]"  placeholder="Employee Name"/ style="font-size: 12px;">
                                        <td style="background: ;">
                                            <input type='text' class="form-control input-sm name" id="name_2" name="names[]"  placeholder="Employee Name"/ style="font-size: 12px;">
                                        </td>
                                        <td style="background: ;">
                                            <input name="dept[]" type='text' class="form-control input-sm dept"   id='dept_2' readonly style="font-size: 12px;">
                                        </td>
                                        <td style="background: ;">
                                            <input type='text' min="0"  class="form-control input-sm den_total" name="den_total[]" id='den_total_2' placeholder="0.00" style="text-align: right; font-size: 12px;">
                                        </td>
                                        <td style="background: ;">
                                            <input type='text' min="0"  class="form-control input-sm amount" name="amount[]" id='amount_2' placeholder="0.00" style="text-align: right; font-size: 12px;">
                                        </td>
                                        <td style="background: ;">
                                            <select class="form-control input-sm type" name="type[]" id="type_2">                          
                                                <option>S</option>
                                                <option>O</option>
                                                <option>PF</option>                           
                                            </select>
                                        </td>      
                                        <td style="background: ;">
                                            <input type='text'  class="form-control input-sm date-picker date" name="date[]"   id='date_2' value="<?php echo date("m/d/Y");?>" style="font-size: 12px; text-align: right;">
                                        </td> 
                                        <td style="background: ;">
                                            <div style="background: red; padding: 0px;" class="col-md-8">                                                
                                                <input type='text'  class="form-control input-sm input_br" name="input_br[]" id='input_br_2' readonly style="font-size: 12px;">
                                                <input type='hidden'  class="form-control input-sm hidden_input_br" name="hidden_input_br[]" id='hidden_input_br_2' style="font-size: 12px;">
                                            </div>
                                            <div style="background:; padding-left: 10px; padding-right: 0px; padding-top: 3px;" class="col-md-4">  
                                                <a id="br_del_btn_1" onClick="showDiv(2);" class="btn btn-xs red"><i class="fa fa-remove"></i></a>
                                            </div>
                                        </td>                                    
                                    </tr> 
                                    <tr>
                                        <input type='hidden' class="form-control emp_id" id="emp_id_3" name="emp_id[]"  placeholder="Employee Name"/ style="font-size: 12px;">
                                        <td style="background: ;">
                                            <input type='text' class="form-control input-sm name" id="name_3" name="names[]"  placeholder="Employee Name"/ style="font-size: 12px;">
                                        </td>
                                        <td style="background: ;">
                                            <input name="dept[]" type='text' class="form-control input-sm dept"   id='dept_3' readonly style="font-size: 12px;">
                                        </td>
                                        <td style="background: ;">
                                            <input type='text' min="0"  class="form-control input-sm den_total" name="den_total[]" id='den_total_3' placeholder="0.00" style="text-align: right; font-size: 12px;">
                                        </td>
                                        <td style="background: ;">
                                            <input type='text' min="0"  class="form-control input-sm amount" name="amount[]" id='amount_3' placeholder="0.00" style="text-align: right; font-size: 12px;">
                                        </td>
                                        <td style="background: ;">
                                            <select class="form-control input-sm type" name="type[]" id="type_3">                          
                                                <option>S</option>
                                                <option>O</option>
                                                <option>PF</option>                           
                                            </select>
                                        </td>      
                                        <td style="background: ;">
                                            <input type='text'  class="form-control input-sm date-picker date" name="date[]"   id='date_3' value="<?php echo date("m/d/Y");?>" style="font-size: 12px; text-align: right;">
                                        </td> 
                                        <td style="background: ;">
                                            <div style="background: red; padding: 0px;" class="col-md-8">                                                
                                                <input type='text'  class="form-control input-sm input_br" name="input_br[]" id='input_br_3' readonly style="font-size: 12px;">
                                                <input type='hidden'  class="form-control input-sm hidden_input_br" name="hidden_input_br[]" id='hidden_input_br_3' style="font-size: 12px;">
                                            </div>
                                            <div style="background:; padding-left: 10px; padding-right: 0px; padding-top: 3px;" class="col-md-4">  
                                                <a id="br_del_btn_1" onClick="showDiv(3);" class="btn btn-xs red"><i class="fa fa-remove"></i></a>
                                            </div>
                                        </td>                                    
                                    </tr> 
                                     <tr>
                                        <input type='hidden' class="form-control emp_id" id="emp_id_4" name="emp_id[]"  placeholder="Employee Name"/ style="font-size: 12px;">
                                        <td style="background: ;">
                                            <input type='text' class="form-control input-sm name" id="name_4" name="names[]"  placeholder="Employee Name"/ style="font-size: 12px;">
                                        </td>
                                        <td style="background: ;">
                                            <input name="dept[]" type='text' class="form-control input-sm dept"   id='dept_4' readonly style="font-size: 12px;">
                                        </td>
                                        <td style="background: ;">
                                            <input type='text' min="0"  class="form-control input-sm den_total" name="den_total[]" id='den_total_4' placeholder="0.00" style="text-align: right; font-size: 12px;">
                                        </td>
                                        <td style="background: ;">
                                            <input type='text' min="0"  class="form-control input-sm amount" name="amount[]" id='amount_4' placeholder="0.00" style="text-align: right; font-size: 12px;">
                                        </td>
                                        <td style="background: ;">
                                            <select class="form-control input-sm type" name="type[]" id="type_4">                          
                                                <option>S</option>
                                                <option>O</option>
                                                <option>PF</option>                           
                                            </select>
                                        </td>      
                                        <td style="background: ;">
                                            <input type='text'  class="form-control input-sm date-picker date" name="date[]"   id='date_4' value="<?php echo date("m/d/Y");?>" style="font-size: 12px; text-align: right;">
                                        </td> 
                                        <td style="background: ;">
                                            <div style="background: red; padding: 0px;" class="col-md-8">                                                
                                                <input type='text'  class="form-control input-sm input_br" name="input_br[]" id='input_br_4' readonly style="font-size: 12px;">
                                                <input type='hidden'  class="form-control input-sm hidden_input_br" name="hidden_input_br[]" id='hidden_input_br_4' style="font-size: 12px;">
                                            </div>
                                            <div style="background:; padding-left: 10px; padding-right: 0px; padding-top: 3px;" class="col-md-4">  
                                                <a id="br_del_btn_1" onClick="showDiv(4);" class="btn btn-xs red"><i class="fa fa-remove"></i></a>
                                            </div>
                                        </td>                                    
                                    </tr>
                                     <tr>
                                        <input type='hidden' class="form-control emp_id" id="emp_id_5" name="emp_id[]"  placeholder="Employee Name"/ style="font-size: 12px;">
                                        <td style="background: ;">
                                            <input type='text' class="form-control input-sm name" id="name_5" name="names[]"  placeholder="Employee Name"/ style="font-size: 12px;">
                                        </td>
                                        <td style="background: ;">
                                            <input name="dept[]" type='text' class="form-control input-sm dept"   id='dept_5' readonly style="font-size: 12px;">
                                        </td>
                                        <td style="background: ;">
                                            <input type='text' min="0"  class="form-control input-sm den_total" name="den_total[]" id='den_total_5' placeholder="0.00" style="text-align: right; font-size: 12px;">
                                        </td>
                                        <td style="background: ;">
                                            <input type='text' min="0"  class="form-control input-sm amount" name="amount[]" id='amount_5' placeholder="0.00" style="text-align: right; font-size: 12px;">
                                        </td>
                                        <td style="background: ;">
                                            <select class="form-control input-sm type" name="type[]" id="type_5">                          
                                                <option>S</option>
                                                <option>O</option>
                                                <option>PF</option>                           
                                            </select>
                                        </td>      
                                        <td style="background: ;">
                                            <input type='text'  class="form-control input-sm date-picker date" name="date[]"   id='date_5' value="<?php echo date("m/d/Y");?>" style="font-size: 12px; text-align: right;">
                                        </td> 
                                        <td style="background: ;">
                                            <div style="background: red; padding: 0px;" class="col-md-8">                                                
                                                <input type='text'  class="form-control input-sm input_br" name="input_br[]" id='input_br_5' readonly style="font-size: 12px;">
                                                <input type='hidden'  class="form-control input-sm hidden_input_br" name="hidden_input_br[]" id='hidden_input_br_5' style="font-size: 12px;">
                                            </div>
                                            <div style="background:; padding-left: 10px; padding-right: 0px; padding-top: 3px;" class="col-md-4">  
                                                <a id="br_del_btn_1" onClick="showDiv(5);" class="btn btn-xs red"><i class="fa fa-remove"></i></a>
                                            </div>
                                        </td>                                    
                                    </tr>                            
                                </tbody>
                            </form>
                        </table>
                    </div>
                </div>         
            </div> 
                <div style="text-align:  right">
                        <button type="button" id="reset_data_btn" class="btn btn-warning btn-sm">Reset</button>
                        <button type="button" id="save_data_btn" class="btn green btn-sm">Save Data</button>
                </div>           
          </div> 

        </div>  
      </div> 
        <div class="row">
            <div class="col-md-12">
            <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject uppercase">denomination table</span>
                        </div>              
                    </div>
                    <div class="portlet-body">
                        <form id="denomination_form">
                            <table class="table table-bordered table-hover table-condensed display" id="cs_data_table">
                                <thead>
                                    <tr>                                                            
                                    <th class="col-md-3">
                                    <center>EMPLOYEE NAME</center>
                                    </th>
                                    <th class="col-md-3 ">
                                    <center>DEPARTMENT</center>
                                    </th>
                                    <th class="col-md-1">
                                    <center>DENOMINATION AMT.</center>
                                    </th>
                                    <th class="col-md-1">
                                    <center>SHOT/OVER AMT.</center>
                                    </th>
                                    <th class="">
                                    <center>TYPE</center>
                                    </th>
                                    <th class="">
                                    <center>DATE</center>
                                    </th>                            
                                    </tr>
                                </thead>
                            </table>
                        </form>            
                    </div> 
                </div>  
            </div>  
        </div>    
      <!-- END PAGE CONTENT INNER -->
    </div>
</div>
  <!-- END PAGE CONTENT -->
</div>



    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>assets/global/plugins/respond.min.js"></script>
    <![endif]--> 
    <script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/src/jquery.maskMoney.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
    <script src="<?php echo base_url();?>assets/frontend/layout/scripts/back-to-top.js" type="text/javascript"></script>

    <script src="<?php echo base_url();?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <!-- <script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> -->
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

    <script src="<?php echo base_url();?>assets/toggle/js/bootstrap-toggle.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/clockface/js/clockface.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script src="<?php echo base_url();?>assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
    <script src="<?php echo base_url();?>assets/global/plugins/jquery-mixitup/jquery.mixitup.min.js" type="text/javascript"></script>
    
    <script src="<?php echo base_url();?>assets/frontend/layout/scripts/layout.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/global/scripts/metronic.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/frontend/pages/scripts/portfolio.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>js/datepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url();?>assets/admin/pages/scripts/components-pickers.js"></script>
    <script src="<?php echo base_url();?>assets/overlay/src/loadingoverlay.min.js"></script>
    <script src="<?php echo base_url();?>assets/overlay/extras/loadingoverlay_progress/loadingoverlay_progress.min.js"></script>


<!-- END PAGE LEVEL PLUGINS -->


    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();
            Layout.initTwitter();
            Portfolio.init();
            ComponentsPickers.init();
        });
    </script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>



<div class="modal fade" id="delete_modal" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Delete</h4>
            </div>
            <div class="modal-body">
                You are about to delete denomination data! Do you really want to continue?
            </div>
            <div class="modal-footer">
            <button type="button" id="btn_delete" class="btn btn-sm btn-success">Save changes</button>
            <button type="button" class="btn default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="success_insert_modal" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Success Dialog</h4>
            </div>
            <div class="modal-body">
                Data successfully saved.
            </div>
            <div class="modal-footer">
            <button type="button" class="btn default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="error_insert_modal" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Error Dialog</h4>
            </div>
            <div class="modal-body">
                Please input correctly the red field(s).
            </div>
            <div class="modal-footer">
            <button type="button" class="btn default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>


<div class="modal fade bs-modal-sm" id="dept_modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Borrow Dialog </h4>
                <input type="hidden" id="dept_code_hidden" class="form-control">
                <input type="hidden" id="dept_name_hidden" class="form-control">
                <input type="hidden" id="input_id_hidden" class="form-control">
            </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Department</label>
                            <div class="col-md-8">
                            <select class="form-control" id="dept_option">                                               
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Sections</label>
                            <div class="col-md-8">
                            <select class="form-control" id="section_option">                                                                    
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Sub-section</label>
                            <div class="col-md-8">
                            <select class="form-control" id="sub_sec_option">                                                                    
                            </select>
                            </div>
                        </div>
                    </form>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn default btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-success" id="borrow_modal_btn">Save</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<script type="text/javascript">

    var cs_data_table;


    $(".den_total").maskMoney({thousands:',', decimal:'.', allowZero: true, suffix: ' '});
    $(".amount").maskMoney({thousands:',', decimal:'.', allowZero: true, suffix: ' '});


    $(document).ready(function()
    {
        $("#den_form").addClass("active");   
    });

    
    cs_data_table = $('#cs_data_table').DataTable(
    {
        'ajax':'<?php echo site_url('main_controller/bu_data');?>',
        //  ordering:false,    
        'columnDefs': [
                      { className: "text-right", "targets": [2, 3] },
                      { className: "text-center", "targets": [4,5] }
                      ],
        "order": [[ 5, "asc" ]],

        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) 
        {
          if ( aData[4] == "S" )
          {
            $('td', nRow).css('color', 'Red');
          }
          else if(aData[4] == "O")
          {
            $('td', nRow).css('color', 'blue');
          }
          else
          {
            $('td', nRow).css('color', 'black');
          }
        }  
    });

    $(".input_br").mouseup(function()
    {
        var id = $(this).attr('id')
        
        var dept_code = $('#dept_code').val();

        $('#dept_option').find('option').remove().end();
        $('#section_option').find('option').remove().end();
        $('#sub_sec_option').find('option').remove().end();

        $('#dept_code_hidden').val("");
        $('#dept_name_hidden').val("");
        $('#input_id_hidden').val("");
        
        $.ajax({
            url:'<?php echo site_url('main_controller/dept_con')?>',
            type:'post',
            data:{dept_code:dept_code},
            success:function(data)
            {
                $('#dept_option').append('<option>Please select</option>');  
                var opts = $.parseJSON(data);                                    
                $.each(opts, function(i, d) 
                {      
                    $('#dept_option').append('<option value='+d.company_code+'-'+d.bunit_code+'-'+d.dept_code+'>'+d.dept_name+'</option>');
                    $('#dept_modal').modal('show');
                });

                $('#input_id_hidden').val(id);
            }
        });
    });
  
    $('#dept_option').change(function() 
    {
         var dept_option =$( "#dept_option" ).val();
         var dept_option_text = $("#dept_option option:selected").text();

        $('#section_option').find('option').remove().end();
        $('#sub_sec_option').find('option').remove().end();

         $.ajax({
            url:'<?php echo site_url('main_controller/section_con')?>',
            type:'post',
            data:{dept_option:dept_option},
            success:function(data)
            {
                $('#section_option').append('<option>Please select</option>'); 

                var opts = $.parseJSON(data);                                    
                $.each(opts, function(i, d) 
                {      
                    $('#section_option').append('<option value='+d.company_code+'-'+d.bunit_code+'-'+d.dept_code+'-'+d.section_code+'>'+d.section_name+'</option>');
                });

                var input_hidden = dept_option_text.slice(0, 3);
                $('#dept_name_hidden').val(input_hidden);
                $('#dept_code_hidden').val(dept_option);
            }
         });
    });

    $('#section_option').change(function() 
    {
         var section_option =$( "#section_option" ).val();
         var section_option_text = $("#section_option option:selected").text();

         var dept_option_text = $("#dept_option option:selected").text();
         var input_hidden = dept_option_text.slice(0, 3);

         $('#sub_sec_option').find('option').remove().end();
         $('#dept_code_hidden').val("");
         $('#dept_name_hidden').val("");


         $.ajax({
            url:'<?php echo site_url('main_controller/sub_section_con')?>',
            type:'post',
            data:{section_option:section_option},
            success:function(data)
            {
                var input_hidden1 = section_option_text.slice(0, 3);
                $('#dept_name_hidden').val(input_hidden+"-"+input_hidden1);
                $('#dept_code_hidden').val(section_option);


                $('#sub_sec_option').append('<option>Please select</option>'); 

                var opts = $.parseJSON(data);                                    
                $.each(opts, function(i, d) 
                {      
                    $('#sub_sec_option').append('<option value='+d.company_code+'-'+d.bunit_code+'-'+d.dept_code+'-'+d.section_code+'-'+d.sub_section_code+'>'+d.sub_section_name+'</option>');
                });

            }
         });
    });

    $('#sub_sec_option').change(function() 
    {
    var dept_option_text = $("#dept_option option:selected").text();
    var input_hidden = dept_option_text.slice(0, 3);
    var section_option_text = $("#section_option option:selected").text();
    var input_hidden1 = section_option_text.slice(0, 3);

        $('#dept_code_hidden').val("");
        var sub_sec_option_text = $("#sub_sec_option option:selected").text();
        var sub_sec_option = $( "#sub_sec_option").val();

        var input_hidden2 = sub_sec_option_text.slice(0, 3);
        $('#dept_name_hidden').val(input_hidden+"-"+input_hidden1+"-"+input_hidden2);
        $('#dept_code_hidden').val(sub_sec_option);
    });

     $('#borrow_modal_btn').click(function()
     {
        var sub_sec_option = $( "#sub_sec_option").val();   

        var split = $('#input_id_hidden').val().split('_');  

        $('#hidden_input_br_'+split[2]).val("");

        $('#'+$('#input_id_hidden').val()).val($('#dept_name_hidden').val());

        $('#hidden_input_br_'+split[2]).val($('#dept_code_hidden').val());

        $('#dept_modal').modal('hide');
     });

     function showDiv(id)
     {
        $('#input_br_'+id).val("");
        $('#hidden_input_br_'+id).val("");
     }

    $(document).on('keydown', '.name', function() 
    { 
        var id = this.id;
        var splitid = id.split('_');
        var index = splitid[1];

        $( '#'+id ).autocomplete(
        {
            source: function( request, response ) 
            {
                $.ajax({
                url: "<?php echo site_url('main_controller/bu_search_name');?>",
                type: 'post',
                dataType: "json",
                data: {
                search: request.term,request:1
                },
                success: function( data ) {
                response( data );
                }
                });
            },

            select: function (event, ui)
            {
                $(this).val(ui.item.label); // display the selected text
                var emp_id = ui.item.value; // selected value

                $.ajax(
                {
                    url: "<?php echo site_url('main_controller/bu_search_name');?>",
                    type: 'post',
                    data: {emp_id:emp_id,request:2},
                    dataType: 'json',
                    success:function(response)
                    {
                        var len = response.length;
                        if(len > 0)
                        {
                            var emp_id   = response[0]['emp_id'];
                            var emp_name = response[0]['emp_name'];
                            var dept     = response[0]['dept'];
                            // Set value to textboxes
                            document.getElementById('emp_id_'+index).value = emp_id;
                            document.getElementById('name_'+index).value = emp_name;
                            document.getElementById('dept_'+index).value = dept;

                            $('#den_total_'+index).focus(); 
                        }
                    }
                });

                return false;
            }
        });
    });


$('#save_data_btn').click(function()
{   
    // $("#form_body").LoadingOverlay("show", {});
    $('#save_data_btn').prop('disabled',true);
    $('#reset_data_btn').prop('disabled',true);
    $.ajax({
      url:"<?php echo site_url('main_controller/save_emp_data_con')?>",
      method:"POST",
      data:$('#add_name').serialize(),
      success:function(data)
      {
        $('#add_name')[0].reset();
        var blank = $.parseJSON(data); 

        if(blank.length == 0)
        {
          for (i = 1; i < 6; i++) 
          {             
            $('#den_total_'+i).css({"background-color":"#ffffff","color":"black"});  
            // $('#date_'+i).css({"background-color":"#ffffff","color":"black"});           
          }

          $('#success_insert_modal').modal('show');
        }
        else
        {          
          for (i = 0; i < blank.length; i++) 
          {    
            if(blank[i].error == "blank")
            {
              var indx = blank[i].index + 1;
              document.getElementById('name_'+indx).value   = blank[i].names;
              document.getElementById('dept_'+indx).value   = blank[i].dept;            
              document.getElementById('den_total_'+indx).value  = blank[i].den_total;
              document.getElementById('amount_'+indx).value  = blank[i].amount;
              document.getElementById('date_'+indx).value   = blank[i].date;
              document.getElementById('type_'+indx).value   = blank[i].types;
              document.getElementById('emp_id_'+indx).value   = blank[i].emp_id;
              document.getElementById('input_br_'+indx).value   = blank[i].input_br;
              document.getElementById('hidden_input_br_'+indx).value   = blank[i].hidden_input_br;

              $('#den_total_'+indx).css({"background-color":"#9f0707","color":"white"});
              // $('#amount_'+indx).css({"border":"2px solid red","color":"black"});
            }
          }          
          $('#error_insert_modal').modal('show');
        } 

          $('#save_data_btn').prop('disabled',false);
          $('#reset_data_btn').prop('disabled',false);
          cs_data_table.ajax.reload(null, false);

      }
    });
 });

$('#reset_data_btn').click(function()
{
    $('#add_name')[0].reset();
});

$("#date_1").change(function()
{
  var date = document.getElementById('date_1').value;  

  $('#date_2').val(date); 
  $('#date_3').val(date); 
  $('#date_4').val(date); 
  $('#date_5').val(date);      
}); 

$("#date_2").change(function()
{
  var date = document.getElementById('date_2').value;  
 
  $('#date_3').val(date); 
  $('#date_4').val(date); 
  $('#date_5').val(date);      
});

$("#date_3").change(function()
{
  var date = document.getElementById('date_3').value;  
 
  $('#date_4').val(date); 
  $('#date_5').val(date);      
});  

$("#date_4").change(function()
{
  var date = document.getElementById('date_4').value;  
 
  $('#date_5').val(date);      
}); 


</script>








