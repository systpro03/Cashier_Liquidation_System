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
    input[type='number'] {
        font-size: 22px;
        text-align: center;
        height: 50px;
        width: 100%;
    }

    input[type='text'] {
        font-size: 22px;
        text-align: center;
        height: 50px;
        width: 100%;
    }
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
                                    <span class="caption-subject uppercase">OTHER MODE OF PAYMENT FORM</span>
                                </div>

                              <!-- <input hidden type="text" id="checkbox_noncashremit"> -->
                              <form style="margin-left: 45%;">
                                <!-- <label class="checkbox-inline" style="font-size: 15px; margin-top: 2%; font-weight: bold;">
                                  <input type="checkbox" id="partial_noncashcheckbox" onclick="checked_noncashpartial()" style="width: 20px; height: 20px; margin-top: -1px; margin-left: -24px;" value="">PARTIAL REMIT
                                </label>
                                <label class="checkbox-inline" style="font-size: 15px; margin-top: 2%; margin-left: 45px; font-weight: bold;">
                                  <input type="checkbox" id="final_noncashcheckbox" onclick="checked_noncashfinal()" style="width: 20px; height: 20px; margin-top: -1px; margin-left: -24px;" value="">FINAL REMIT
                                </label> -->
                                <label class="checkbox-inline" style="font-size: 15px; margin-top: 2%; margin-left: 45px; font-weight: bold;">
                                  <input type="checkbox" disabled id="borrow_checkbox" onclick="checked_borrow()" style="width: 20px; height: 20px; margin-top: -1px; margin-left: -24px;" value="">BORROW
                                </label>
                              </form>

                              <form hidden id="cash_section_form">
                                <center><label class="checkbox-inline" style="font-size: 15px; margin-top: 2%; font-weight: bold;">
                                  <select name="cash_section" id="cash_section" onchange="get_sub_section_js()">
                                    <option id="" style="text-align: center;" disabled selected value="">SELECT SECTION</option>
                                  </select>
                                </label>
                                <label class="checkbox-inline" style="font-size: 15px; margin-top: 2%; margin-left: 45px; font-weight: bold;">
                                  <select name="cash_subsection" id="cash_subsection">
                                    <option id="" style="text-align: center;" disabled selected value="">SELECT SUB SECTION</option>
                                  </select>
                                </label></center>
                              </form>

                            </div>
                            <div class="portlet-body">
                                <div class="form-body" id="form_body">
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-bordered table-hover display" style="color: black; font-size: 12px;">
                                            <thead>
                                                <tr>

                                                    <th width="40%">
                                                        <center>PAYMENT TYPE
                                                        </th>
                                                        <th width="30%">
                                                            <center>QUANTITY
                                                            </th>
                                                            <th width="30%">
                                                                <center>AMOUNT
                                                                </th>

                                                            </tr>
                                                        </thead>
                                                        <input hidden="" id="data"> 
                                                        <input hidden="" id="batch_id">
                                                        <input hidden id="noncash_trno">
                                                        <form name="noncash_form" id="noncash_form">
                                                            <tbody id="tbody_mop">

                                                                <!-- display mode of payment form -->

                                                            </tbody>
                                                        </form>
                                                    </table>
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
                <script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>

                <script src="<?php echo base_url();?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
                <script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
                <script src="<?php echo base_url();?>assets/frontend/layout/scripts/back-to-top.js" type="text/javascript"></script>
                <div id="load_js"></div>



<script type="text/javascript">


// ==========================================display mode of payment name==========================================================
display_mop_js();
disabled_noncashform();
get_batchid_js();

</script>


<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/frontend/layout/scripts/back-to-top.js" type="text/javascript"></script>


<script src="<?php echo base_url(); ?>assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/frontend/pages/scripts/revo-slider-init.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/frontend/layout/scripts/layout.js" type="text/javascript"></script>



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