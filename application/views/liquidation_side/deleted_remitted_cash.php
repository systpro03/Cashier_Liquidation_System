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

<body class="corporate">

    <?php
      $this->load->view('header');
      $this->load->view('liquidation_side/liquidation_js');
    ?>

<div class="page-container">

  <!-- END PAGE HEAD -->
  <!-- BEGIN PAGE CONTENT -->
  <div class="page-content" style="background: #ffffff;">
    <div class="container">
    
        <div class="row">
            <div class="col-md-12">
            <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject uppercase">batch remitted cash table</span>
                        </div>              
                    </div>
                    <!-- <form class="form-inline">
                      <center>
                        <label style="font-weight: bold">FILTER DATE:</label>
                        <input type="date" onchange="deleted_remitted_cash_js()" style="height: 35px;" id="filter_date" value="<?php echo date('Y-m-d'); ?>">
                      </center>
                    </form> -->
                    <div class="portlet-body" id="divbody_deleted_remitted_cash_table">
                       <!-- ==========transferred denomination table list==================== -->
                    </div> 
                </div>  
            </div>  
        </div>    
      <!-- END PAGE CONTENT INNER -->
    </div>
  </div>
  <!-- END PAGE CONTENT -->
</div>

    <script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/src/jquery.maskMoney.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
    <script src="<?php echo base_url();?>assets/frontend/layout/scripts/back-to-top.js" type="text/javascript"></script>
    
<!-- =========================================================DATATABLE BUTTONS PLUGINS============================================================== -->
     <!-- <script src="<?php echo base_url();?>datatables_buttons_plugins/jquery-3.5.1.js" type="text/javascript"></script> -->
     <script src="<?php echo base_url();?>datatables_buttons_plugins/jquery.dataTables.min.js" type="text/javascript"></script>
     <script src="<?php echo base_url();?>datatables_buttons_plugins/dataTables.buttons.min.js" type="text/javascript"></script>
     <script src="<?php echo base_url();?>datatables_buttons_plugins/jszip.min.js" type="text/javascript"></script>
     <script src="<?php echo base_url();?>datatables_buttons_plugins/pdfmake.min.js" type="text/javascript"></script>
     <script src="<?php echo base_url();?>datatables_buttons_plugins/vfs_fonts.js" type="text/javascript"></script>
     <script src="<?php echo base_url();?>datatables_buttons_plugins/buttons.html5.min.js" type="text/javascript"></script>
     <script src="<?php echo base_url();?>datatables_buttons_plugins/buttons.print.min.js" type="text/javascript"></script>
<!-- ================================================================================================================================================ -->

    <script type="text/javascript">

        deleted_remitted_cash_js();

    // ====================disabled future date +1======================================
        $(function(){
            var dtToday = new Date();

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();

            if(month < 10)
                month = '0' + month.toString();
            if(day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;    
            $('#filter_date').attr('max', maxDate);
        });
    // ===================================================================================

    /*======================================auto comma in number=================================================================*/
    $(".d_amount").maskMoney({thousands:',', decimal:'.', allowZero: true, suffix: ' '});
    /*=============================================================================================================================*/

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









