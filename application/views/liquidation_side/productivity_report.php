    <!DOCTYPE html>

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

/*table.display tbody tr:nth-child(even):hover td
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
*/

/*=========================PENDING MODAL STYLE==================================*/
* {
  box-sizing: border-box;
}

/*=======================THREE COLUMN LAYOUT=====================*/
/* Create three equal columns that floats next to each other */
/*.column {
  float: left;
  width: 33.33%;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration 
}*/

/* Clear floats after the columns */
/*.row:after {
  content: "";
  display: table;
  clear: both;
}*/
/*=============================================================*/


/*====================TWO COLUMN LAYOUT========================*/
/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
/*=============================================================*/

/* Important part */
.dialog{
    /*overflow-y: initial !important*/
}
.portlet-body{
    /* height: 115vh;
    overflow-y: auto; */
}
/*=============================END==============================================*/

.txt{
    text-align: right;
}

.data{
    text-align: center;
}

#loading {
    background: url('loading_gif/Walk.gif') no-repeat center center;
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: 9999999;
    text-align: center;
}

.ui-autocomplete
{
  font-size: 18px;
}

h1.hidden {
  display: none;
}

</style>
</head>

<body class="corporate">

    <?php
      $this->load->view('header');
      $this->load->view('liquidation_side/liquidation_js');
    ?>


<!-- ==============================================================CASHIER ACCESS SETUP======================================================== -->
<div class="page-container">

  <!-- END PAGE HEAD -->
  <!-- BEGIN PAGE CONTENT -->
  <div class="page-content" style="background: #ffffff;">
    <div class="container">
    
        <div class="row">
            <div class="col-md-12">
            <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet light dialog">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject uppercase">filter cashier and month for productivity report</span>
                        </div>              
                    </div>

    <div class="portlet-body row" id="divbody_cashier_counter">
               
        <form class="form-inline">
          <center>
            <label style="font-weight: bold; font-size: 15px;">BUSINESS UNIT:</label>
            <select class="input-sm data" onchange="setup_counter_get_dept_name_js()" id="bunit_name" style="height: 35px; width: 25%;"></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label style="font-weight: bold; font-size: 15px;">DEPARTMENT:</label>
            <select class="input-sm data" onchange="unchecked_borrow_js()" id="dept_name" style="height: 35px; width: 25%;"></select><br><br>
            <!-- =========================================================================================================================================================== -->
            <label style="font-weight: bold; font-size: 15px;">SEARCH EMPLOYEE:</label>
            <input class="input-sm data" autocomplete="off" onkeyup="search_emp_js()" id="emp_name" style="height: 35px; width: 25%;"></input>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label style="font-weight: bold; font-size: 15px;">MONTH:</label>
            <select class="input-sm" style="height: 35px;" id="month">
              <option value="01">JANUARY</option>
              <option value="02">FEBRUARY</option>
              <option value="03">MARCH</option>
              <option value="04">APRIL</option>
              <option value="05">MAY</option>
              <option value="06">JUNE</option>
              <option value="07">JULY</option>
              <option value="08">AUGUST</option>
              <option value="09">SEPTEMBER</option>
              <option value="10">OCTOBER</option>
              <option value="11">NOVEMBER</option>
              <option value="12">DECEMBER</option>
            </select>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label style="font-weight: bold; font-size: 15px;">YEAR:</label>
            <select class="input-sm" style="height: 35px;" id="year"></select>
          </center>
        </form><br>
        <!-- ======================================================================================================================================== -->
        <footer>
          <div id="footer-content">
              <center><button type="button" id="set_counter_btn" class="btn btn-warning waves-effect" onclick="view_productivity_js()">VIEW PRODUCTIVITY</button></center>
          </div>
        </footer>
        <!-- ======================================================================================================================================== -->

                    </div> 
                </div>  
            </div>  
        </div>    
      <!-- END PAGE CONTENT INNER -->
    </div>
</div>
  <!-- END PAGE CONTENT -->
</div>
<!-- ==========================================================END CASHIER ACCESS SETUP======================================================== -->


<!-- ==============================================================CASHIER ACCESS SETUP======================================================== -->
<div class="page-container">

  <!-- END PAGE HEAD -->
  <!-- BEGIN PAGE CONTENT -->
  <div class="page-content" style="background: #ffffff;">
    <div class="container">
    
        <div class="row">
            <div class="col-md-12">
            <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet light dialog">
                    <div class="portlet-title">
                        <div class="caption" style="font-weight: bold; font-family: cursive;">
                            <span class="caption-subject uppercase" id="cname"></span>
                            <span class="caption-subject uppercase">productivity report</span>
                            <span class="caption-subject uppercase" id="cmonth"></span>
                            <span class="caption-subject uppercase" id="cyear"></span>
                        </div>              
                    </div>

                    <div class="portlet-body row" id="divbody_cashier_productivity">
                        <!-- ======================================================================================================================================== -->
                      
                        <!-- ======================================================================================================================================== -->
                    </div> 
                </div>  
            </div>  
        </div>    
      <!-- END PAGE CONTENT INNER -->
    </div>
</div>
  <!-- END PAGE CONTENT -->
</div>
<!-- ==========================================================END CASHIER ACCESS SETUP======================================================== -->

    <script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/src/jquery.maskMoney.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
    <script src="<?php echo base_url();?>assets/frontend/layout/scripts/back-to-top.js" type="text/javascript"></script>

    <div id="load_js"></div>

  

    <script type="text/javascript">

      setup_counter_get_bunit_name_js();
      disabled_search_js();
      get_year_js();

       
    </script>


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


<script type="text/javascript">

 
  
</script>








