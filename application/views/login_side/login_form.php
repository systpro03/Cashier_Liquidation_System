<html lang="en">
<link href="<?php echo base_url();?>assets/global/css/components.css" rel="stylesheet">

<head>
    <title>CASHIER LOG-IN</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="<?php echo base_url();?>login_template/images/icons/favicon.ico"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>login_template/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>login_template/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>login_template/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>login_template/vendor/animate/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>login_template/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>login_template/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>login_template/vendor/select2/select2.min.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>login_template/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>login_template/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>login_template/css/main.css">
<!--===============================================================================================-->

</head>

<!-- Body BEGIN -->
<body>
    <div id="qr-reader" style="width: 600px"></div>    



	<div class="limiter">
        <div class="container-login100" style="background-image: url('login_template/images/bg-01.jpg');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <span class="login100-form-title p-b-41">
                    Cashier Login
                </span>
                <form class="login100-form validate-form p-b-33 p-t-5" id="barcode_form">

                    <div class="wrap-input100 validate-input" data-validate = "Scan barcode infront of your ID">
                        <input class="input100" autocomplete="off" type="number" min="0" name="barcode_input" id="barcode_input" placeholder="Scan barcode infront of your ID">
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100" autocomplete="off" type="password" name="pass" id="barcode_pass" placeholder="Scan barcode back of your ID">
                        <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                    </div>

                    <input type="button" hidden id="go" />
                    <!-- <div class="container-login100-form-btn m-t-32">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div> -->

                </form>
            </div>
        </div>
    </div>
    

    <div id="dropDownSelect1"></div>
    
<!--===============================================================================================-->
    <script src="<?php echo base_url();?>login_template/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="<?php echo base_url();?>login_template/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
    <script src="<?php echo base_url();?>login_template/vendor/bootstrap/js/popper.js"></script>
    <script src="<?php echo base_url();?>login_template/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="<?php echo base_url();?>login_template/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="<?php echo base_url();?>login_template/vendor/daterangepicker/moment.min.js"></script>
    <script src="<?php echo base_url();?>login_template/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
    <script src="<?php echo base_url();?>login_template/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
    <script src="<?php echo base_url();?>login_template/js/main.js"></script>


<!-- swal alert -->
<script src="<?php echo base_url('assets/js/dataTables.fixedHeader.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2@11.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.min.js'); ?>"></script>


    <script type="text/javascript">
        
        $(function() {
            $('#barcode_input').focus();
        });
// ==========================ENTER FUNCTION==============================
        $("#barcode_input, #barcode_pass").keypress(function(e) {
            if(e.which == 13) {
                $("#go").click();
            }
        });
// =========================================================================
        $("#barcode_input").keyup(function() {
            if($(this).val().length >= 11)
            {
                $('#barcode_pass').focus();
            }
            // ======================================
            if($('#barcode_pass').val().length >= 12)
            {
                $("#go").click();
            }
        })
// =========================================================================
        $("#barcode_pass").keyup(function() {
            if ($(this).val().length >= 12)
            $("#go").click();
        })
// ========================================================================
        $("#go").click(function(e){
            if($("#barcode_input").val() == '')
            {
                return;
            }
            else if($("#barcode_pass").val() == '')
            {
                return;
            }
            else
            {
                e.preventDefault();
                var front = $("#barcode_input").val();
                var back = $("#barcode_pass").val();
                validate_user_js(front,back);
            }
        });
// =====================================================================

    </script>

</body>
</html>