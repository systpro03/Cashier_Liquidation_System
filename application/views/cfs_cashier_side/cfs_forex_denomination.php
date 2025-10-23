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

.input-sm {
    font-size: 15px;
    text-align: center;
    width: 100%;
    height: 35px;
}

.portlet-body{
    overflow-y: auto;
}

</style>
</head>

<body class="corporate">

    <?php
      $this->load->view('cfs_cashier_side/header');
      $this->load->view('cfs_cashier_side/cfs_cashier_js');
    ?>

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
                            <span class="caption-subject uppercase">forex denomination table</span>
                        </div>              
                    </div>

    <div class="portlet-body" id="divbody_cfsforex_denominationform">
                      
    <!-- ===========================================CASH DENOMINATION FORM========================================= -->
          <div class="column">
            <div id="cfsforex_duplicater0">
                <form>
                  <center>
                    <label id="forex_selectlbl" style="font-size: 15px; margin-top: -1%; font-weight: bold;">SELECT CURRENCY&nbsp;</label>
                    <select class="val20" onchange="display_forex_denomination_form_js()" style="font-size: 15px; margin-top: -1%; font-weight: bold; border: solid 2px;" name="cfs_forex_list" id="cfs_forex_list">
                      
                    </select>
                    <input type="button" id="forex_plus" class="btn-primary waves-effect" value="➕" onclick="forex_form_duplicate_js()" style="margin-top: -1%; border: 1px;">
                    <input type="button" id="forex_minus" class="btn-warning waves-effect" value="➖" onclick="forex_form_remove_div_js()" style="margin-top: -1%; border: 1px;">
                  </center>
                </form>

          <input hidden id="forex_trno"> 
          <input hidden id="cfsforex_counter"> 
          <div class="table-scrollable">
            <table class="table table-striped table-bordered table-hover display">
              <thead>
                <tr>

                  <th style="font-weight: bold; font-size: 15px;" width="20%">
                    <center>DENOMINATION
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="20%">
                    <center>QUANTITY
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="20%">
                    <center>TOTAL FRGN. CUR.
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="20%">
                    <center>EXCHANGE RATE
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="20%">
                    <center>PESO AMOUNT
                  </th>
                  </tr>
              </thead>
              <input hidden id="forex_form_counter" value="21">
                <form name="cfscashier_forexform" id="cfscashier_forexform">
                    <tbody id="cfscashier_forextbody">
                      
                    </tbody>
                </form>
            </table>
          </div>
          </div>

             <div class="cfsforex_add">

              
             </div>

            <footer id="footer">
              <div id="footer-content" style="float: right;">
                 <button type="button" id="submit_cfsforexden" class="btn btn-warning waves-effect" onclick="submit_forex_denomination_js()">SUBMIT</button>
                 <button type="button" id="reset_cfsforexden" class="btn btn-primary waves-effect" onclick="reset_forex_denomination_js()">RESET</button>
              </div>
            </footer>

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


    <script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/src/jquery.maskMoney.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
    <script src="<?php echo base_url();?>assets/frontend/layout/scripts/back-to-top.js" type="text/javascript"></script>

    <div id="load_js"></div>

    <script type="text/javascript">

        display_forex_currency_js();
        // get_cfsbatchid_js();
      
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








