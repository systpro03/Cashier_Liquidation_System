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

    /*.swal2-container
    {
        z-index: 300000!important;
    }*/

</style>

<body class="corporate">

    <?php
    $this->load->view('cashier_side/header');
    $this->load->view('cashier_side/cashier_js');
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
                                    <span class="caption-subject uppercase">PARTIAL CASH DENOMINATION FORM</span>
                                </div>
                                
                              <input hidden type="text" id="checkbox_cashremit">
                              <input hidden type="text" id="cash_trno">
                              <form style="margin-left: 38%;">
                                <label class="checkbox-inline" style="font-size: 15px; margin-top: 2%; font-weight: bold;">
                                  <!-- <input type="checkbox" id="partial_checkbox" onclick="checked_partial()" style="width: 20px; height: 20px; margin-top: -1px; margin-left: -24px;" value="">PARTIAL REMITTANCE -->
                                  <input type="checkbox" id="partial_checkbox" disabled style="width: 20px; height: 20px; margin-top: -1px; margin-left: -24px;" value="">PARTIAL REMITTANCE
                                </label>
                                <label class="checkbox-inline" style="font-size: 15px; margin-top: 2%; margin-left: 45px; font-weight: bold;">
                                  <input type="checkbox" disabled id="borrow_checkbox" onclick="checked_borrow()" style="width: 20px; height: 20px; margin-top: -1px; margin-left: -24px;" value="">BORROW
                                </label>
                              </form>

                              <form hidden id="cash_section_form">
                                <center>
                                    <select style="font-size: 17px; font-weight: bold;" name="cash_section" id="cash_section" onchange="get_sub_section_js()">
                                        <option id="" style="text-align: center;" disabled selected value="">SELECT SECTION</option>
                                    </select>
                                    &nbsp;&nbsp;&nbsp;
                                    <select style="font-size: 17px; font-weight: bold;" name="cash_subsection" id="cash_subsection">
                                        <option id="" style="text-align: center;" disabled selected value="">SELECT SUB SECTION</option>
                                    </select>
                                </center>
                              </form>

                              <form>
                                <center>
                                        <select id="pos_name" style="font-size: 17px; font-weight: bold;" onchange="get_counter_no_js()"></select>
                                        &nbsp;&nbsp;&nbsp;
                                        <span id="counter_no" style="font-size: 17px; font-weight: bold;"></span>
                                </center>
                              </form>

                            </div>
                            <div class="portlet-body">
                                <div class="form-body" id="form_body">
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-bordered table-hover display" style="color: black; font-size: 12px;">
                                            <thead>
                                                <tr>
                                                    <th width="30%">
                                                        <center>DENOMINATION
                                                    </th>
                                                    <th width="30%">
                                                        <center>QUANTITY
                                                    </th>
                                                    <th width="40%">
                                                        <center>AMOUNT
                                                    </th>
                                                </tr>
                                                        </thead>
                                                        <form name="cash_form" id="cash_form">
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <input type="text" class="input-sm" id="d_onek" disabled="" placeholder="₱1,000">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" min="0" android:inputType="number" class="input-sm quantity" id="q_onek" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" placeholder="0">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="input-sm d_amount" readonly="" disabled id="a_onek" placeholder="0" value="0">
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <input type="text" class="input-sm" id="d_fiveh" disabled="" placeholder="₱500">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" min="0" class="input-sm quantity quantity1" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fiveh" placeholder="0">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="input-sm d_amount" readonly="" disabled id="a_fiveh" placeholder="0" value="0">
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <input type="text" class="input-sm" id="d_twoh" disabled="" placeholder="₱200">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" min="0" class="input-sm quantity quantity2" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twoh" placeholder="0">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="input-sm d_amount" readonly="" disabled id="a_twoh" placeholder="0" value="0">
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <input type="text" class="input-sm" id="d_oneh" disabled="" placeholder="₱100">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" min="0" class="input-sm quantity quantity3" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_oneh" placeholder="0">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="input-sm d_amount" readonly="" disabled id="a_oneh" placeholder="0" value="0">
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <input type="text" class="input-sm" id="d_fifty" disabled="" placeholder="₱50">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" min="0" class="input-sm quantity quantity4" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fifty" placeholder="0">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="input-sm d_amount" readonly="" disabled id="a_fifty" placeholder="0" value="0">
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <input type="text" class="input-sm" id="d_twenty" disabled="" placeholder="₱20">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" min="0" class="input-sm quantity quantity5" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twenty" placeholder="0">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="input-sm d_amount" readonly="" disabled id="a_twenty" placeholder="0" value="0">
                                                                    </td>
                                                                </tr>

                                                                <tr hidden id="trcash_ten">
                                                                    <td>
                                                                        <input type="text" class="input-sm" id="d_ten" disabled="" placeholder="₱10">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" min="0" class="input-sm quantity quantity6" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_ten" placeholder="0">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="input-sm d_amount" readonly="" disabled id="a_ten" placeholder="0" value="0">
                                                                    </td>
                                                                </tr>

                                                                <tr hidden id="trcash_five">
                                                                    <td>
                                                                        <input type="text" class="input-sm" id="d_five" disabled="" placeholder="₱5">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" min="0" class="input-sm quantity quantity7" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_five" placeholder="0">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="input-sm d_amount" readonly="" disabled id="a_five" placeholder="0" value="0">
                                                                    </td>
                                                                </tr>

                                                                <tr hidden id="trcash_one">
                                                                    <td>
                                                                        <input type="text" class="input-sm" id="d_one" disabled="" placeholder="₱1">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" min="0" class="input-sm quantity quantity8" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_one" placeholder="0">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="input-sm d_amount" readonly="" disabled id="a_one" placeholder="0" value="0">
                                                                    </td>
                                                                </tr>

                                                                <tr hidden id="trcash_twentyfivecents">
                                                                    <td>
                                                                        <input type="text" class="input-sm" id="d_twentyfivecents" disabled="" placeholder="₱0.25">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" min="0" class="input-sm quantity quantity9" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_twentyfivecents" placeholder="0">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="input-sm d_amount" readonly="" disabled id="a_twentyfivecents" placeholder="0" value="0">
                                                                    </td>
                                                                </tr>

                                                                <tr hidden id="trcash_tencents">
                                                                    <td>
                                                                        <input type="text" class="input-sm" id="d_tencents" disabled="" placeholder="₱0.10">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" min="0" class="input-sm quantity quantity10" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_tencents" placeholder="0">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="input-sm d_amount" readonly="" disabled id="a_tencents" placeholder="0" value="0">
                                                                    </td>
                                                                </tr>

                                                                <tr hidden id="trcash_fivecents">
                                                                    <td>
                                                                        <input type="text" class="input-sm" id="d_fivecents" disabled="" placeholder="₱0.05">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" min="0" class="input-sm quantity quantity11" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_fivecents" placeholder="0">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="input-sm d_amount" readonly="" disabled id="a_fivecents" placeholder="0" value="0">
                                                                    </td>
                                                                </tr>

                                                                <tr hidden id="trcash_onecents">
                                                                    <td>
                                                                        <input type="text" class="input-sm" id="d_onecents" disabled="" placeholder="₱0.01">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" min="0" class="input-sm quantity quantity12" onchange="calculate_breakdown_js()" onkeyup="calculate_breakdown_js()" id="q_onecents" placeholder="0">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="input-sm d_amount" readonly="" disabled id="a_onecents" placeholder="0" value="0">
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td style="float: right;">
                                                                        <button type="button" id="btn_reset_cashform" style="height: 50px; width: 100px; font-size: 22px;" class="btn btn-primary waves-effect" onclick="reset_cashform()">RESET</button>
                                                                        <button type="button" id="btn_save_cashform" style="height: 50px; width: 120px; font-size: 22px;" class="btn btn-warning waves-effect" onclick="view_cashconfimation_modal()">SUBMIT</button>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="input-sm" id="total_cashtxt" disabled="" placeholder="TOTAL CASH">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="input-sm" readonly disabled id="total_cash" placeholder="0.00">
                                                                    </td>
                                                                </tr>
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
                <script src="<?php echo base_url();?>assets/src/jquery.maskMoney.js" type="text/javascript"></script>
                <script src="<?php echo base_url();?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
                <script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
                <script src="<?php echo base_url();?>assets/frontend/layout/scripts/back-to-top.js" type="text/javascript"></script>


                <script type="text/javascript">
                    
                validate_cash_access_js();

                $('.quantity').on('change keyup top press', function() {
                  var sanitized = $(this).val().replace(/[^0-9]/g, '');
                  $(this).val(sanitized);
                  calculate_breakdown_js();
                });
                // ===============================================CHECKED PARTIAL=====================================================================
                $(function() {
                    $("#partial_checkbox").prop('checked', true);
                    $('#checkbox_cashremit').val('PARTIAL');
                    $('#q_onecents').val(0);
                    $('#q_fivecents').val(0);
                    $('#q_tencents').val(0);
                    $('#q_twentyfivecents').val(0);
                    $('#q_one').val(0);
                    $('#q_five').val(0);
                    $('#q_ten').val(0);
                });
                 /*=============================================Disabled (-+e)================================================================*/
                 document.querySelector(".quantity").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector(".quantity1").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector(".quantity2").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector(".quantity3").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector(".quantity4").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector(".quantity5").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector(".quantity6").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector(".quantity7").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector(".quantity8").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector(".quantity9").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector(".quantity10").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector(".quantity11").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });

                 document.querySelector(".quantity12").addEventListener("keypress", function (evt) {
                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                    {
                        evt.preventDefault();
                    }
                });
                 /*============================================================================================================================*/

                 /*======================================auto comma in number=================================================================*/
                  // $(".d_amount").maskMoney({thousands:',', decimal:'.', allowZero: true, suffix: ' '});
                 /*=============================================================================================================================*/

             </script>
             <!-- Load javascripts at bottom, this will reduce page load time -->
             <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
<![endif]-->
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/frontend/layout/scripts/back-to-top.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
<script src="<?php echo base_url(); ?>assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
<script src="<?php echo base_url(); ?>assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->

<!-- BEGIN RevolutionSlider -->
<script src="<?php echo base_url(); ?>assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/frontend/pages/scripts/revo-slider-init.js" type="text/javascript"></script>
<!-- END RevolutionSlider -->

<script src="<?php echo base_url(); ?>assets/frontend/layout/scripts/layout.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        Layout.init();
        Layout.initOWL();
        RevosliderInit.initRevoSlider();
        Layout.initTwitter();
            //Layout.initFixHeaderWithPreHeader(); /* Switch On Header Fixing (only if you have pre-header) */
            //Layout.initNavScrolling(); 
        });

    $("#dashboard").addClass("active");
           /*=======================================================================================================================*/
</script>
       <!-- END PAGE LEVEL JAVASCRIPTS -->
   </body>

   </html>