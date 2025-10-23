<html lang="en">
<!--<![endif]-->
<!-- Head BEGIN -->

<head>
    <meta charset="utf-8">
    <title>CS CASHIER</title>

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
    <link href="<?php echo base_url(); ?>assets/admin.css" rel="stylesheet" type="text/css">
    <!-- Fonts END -->

    <!-- Global styles START -->
    <link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Global styles END -->

    <!-- Page level plugin styles START -->
    <link href="<?php echo base_url(); ?>assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
    <!-- Page level plugin styles END -->

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/global/plugins/select2/select2.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
    <!-- END PAGE LEVEL STYLES -->

    <!-- Theme styles START -->
    <link href="<?php echo base_url(); ?>assets/global/css/components.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/frontend/layout/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/frontend/pages/css/portfolio.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/frontend/layout/css/style-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/frontend/layout/css/themes/red.css" rel="stylesheet" id="style-color">
    <link href="<?php echo base_url(); ?>assets/frontend/layout/css/custom.css" rel="stylesheet">
    <!-- Theme styles END -->

    <link href="<?php echo base_url(); ?>assets/global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/global/css/plugins-md.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
    <link href="<?php echo base_url(); ?>assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet">
</head>
<!-- Head END -->

<!-- Body BEGIN -->

<style type="text/css">
   
</style>

<body class="corporate">

    <?php
    $this->load->view('cashier_side/header');
    $this->load->view('cashier_side/cashier_js');
    ?>

    <div class="page-container">


        <div class="page-content" style="background: #ffffff;">
            <div class="container">


                <div class="row">
                    <div class="col-md-12">

                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject uppercase">NONCASH DENOMINATION FORM</span>
                                </div>

                              <!-- <input hidden type="text" id="checkbox_noncashremit"> -->
                              <form style="margin-left: 32%;">
                                <!-- <label class="checkbox-inline" style="font-size: 15px; margin-top: 2%; font-weight: bold;">
                                  <input type="checkbox" id="partial_noncashcheckbox" onclick="checked_noncashpartial()" style="width: 20px; height: 20px; margin-top: -1px; margin-left: -24px;" value="">PARTIAL REMIT
                                </label>
                                <label class="checkbox-inline" style="font-size: 15px; margin-top: 2%; margin-left: 45px; font-weight: bold;">
                                  <input type="checkbox" id="final_noncashcheckbox" onclick="checked_noncashfinal()" style="width: 20px; height: 20px; margin-top: -1px; margin-left: -24px;" value="">FINAL REMIT
                                </label> -->
                                <label class="checkbox-inline" style="font-size: 15px; margin-top: 2%; margin-left: 45px; font-weight: bold;">FINAL REMITTANCE</label>
                                <label class="checkbox-inline" style="font-size: 15px; margin-top: 2%; margin-left: 45px; font-weight: bold;">
                                  <input type="checkbox" disabled id="borrow_checkbox" onclick="checked_borrow()" style="width: 20px; height: 20px; margin-top: -1px; margin-left: -24px;" value="">BORROW
                                </label>
                              </form>

                              <form hidden id="cash_section_form">
                                <center>
                                  <select style="font-size: 17px; font-weight: bold;" name="cash_section" id="cash_section" onchange="get_sub_section_js()">
                                    <option id="" style="text-align: center;" disabled selected value="">SELECT SECTION</option>
                                  </select>
                                  <select style="font-size: 17px; font-weight: bold;" name="cash_subsection" id="cash_subsection">
                                    <option id="" style="text-align: center;" disabled selected value="">SELECT SUB SECTION</option>
                                  </select>
                                </center>
                              </form>

                              <form id="pos_form">
                                <center>
                                        <select id="pos_name" style="font-size: 17px; font-weight: bold;" onchange="get_counter_no_js()"></select>
                                        &nbsp;&nbsp;&nbsp;
                                        <span id="counter_no" style="font-size: 17px; font-weight: bold;"></span>
                                </center>
                              </form><br>

                              <form>
                                <center>
                                        <select id="mop_name" style="font-size: 17px; font-weight: bold;"></select>
                                        &nbsp;&nbsp;&nbsp;
                                        <span id="" style="font-size: 17px; font-weight: bold;">Quantity:</span>
                                        <input id="nc_quantity" min="1" type="number" class="nc_quantity" style="font-size: 17px; font-weight: bold; text-align: center; width: 80px;"></input>
                                        &nbsp;&nbsp;&nbsp;
                                        <span id="" style="font-size: 17px; font-weight: bold;">Amount:</span>
                                        <!-- <input id="nc_amount" class="nc_amount" style="font-size: 17px; font-weight: bold; text-align: center; width: 150px;"></input> -->
                                        <input id="nc_amount" style="font-size: 17px; font-weight: bold; text-align: center; width: 150px;"></input>
                                        <input id="plus_btn" type="button" style="font-size: 17px; font-weight: bold; text-align: center; background-color: limegreen;" value="➕" onclick="get_noncash_trno_js()"></input>
                                </center>
                              </form>

                            </div>
                            <input hidden id="noncash_trno">
                            <div class="portlet-body">
                                <div  id="div_mop">

                                </div>

                                <footer id="noncash_footer">
                                  <center>
                                    <div id="footer-content">
                                      <button type="button" id="save_noncash_btn" class="btn btn-warning waves-effect" onclick="submit_noncash_js()">SUBMIT</button>
                                    </div>
                                  </center>
                                </footer>
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

    <!-- =========================================auto comma plugin ======================================= -->
    <script src="<?php echo base_url();?>auto_comma_plugins/jquery.min.js" type="text/javascript"></script>
    <!-- ================================================================================================== -->
    
<script type="text/javascript">

// ==========================================display mode of payment name==========================================================
    validate_borrowed_js_v2();
    check_pending_js();
/*=============================================Disabled (-+e)================================================================*/
    document.querySelector(".nc_quantity").addEventListener("keypress", function (evt) {
    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
    {
        evt.preventDefault();
    }
    });
/*======================================auto comma in number=================================================================*/
    // $(".nc_amount").maskMoney({thousands:',', decimal:'.', allowZero: true, suffix: ' '});
    $('input.number').keyup(function(event) {
      // skip for arrow keys
      if(event.which >= 37 && event.which <= 40) return;
      // format number
      $(this).val(function(index, value) {
        return value
        .replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        ;
      });
    });
/*=============================================================================================================================*/

</script>

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



<script type="text/javascript">
    jQuery(document).ready(function() {
        Layout.init();
        Layout.initOWL();
        RevosliderInit.initRevoSlider();
        Layout.initTwitter();

    });

    $("#dashboard").addClass("active");


</script>
<!-- END PAGE LEVEL JAVASCRIPTS -->
</body>

</html>