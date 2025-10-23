    
    <!-- ==========================================for topnav style================================ -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<!-- <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet"> -->

<!-- <style>
  body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
  }

  .topnav {
    overflow: hidden;
    background-color: #fff;
  }

  .topnav a {
    float: left;
    display: block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
  }

  .topnav a:hover {
    background-color: #ddd;
    color: #e45000;
  }

  .topnav a.active {
    background-color: #e45000;
    color: white;
  }

  .topnav .icon {
    display: none;
  }

  @media screen and (max-width: 600px) {
    .topnav a:not(:first-child) {display: none;}
    .topnav a.icon {
      float: right;
      display: block;
    }
  }

  @media screen and (max-width: 600px) {
    .topnav.responsive {position: relative;}
    .topnav.responsive .icon {
      position: absolute;
      right: 0;
      top: 0;
    }
    .topnav.responsive a {
      float: none;
      display: block;
      text-align: left;
    }
  }
</style> -->

<!-- =========================================for old header style ========================================-->
<style>
      .dropbtn {
        background-color: #fff;
        color: black;
        padding: 10px;
        border: none;
        margin-top: 11%;
      }

      .dropbtn2 {
        background-color: #fff;
        color: black;
        padding: 10px;
        border: none;
        margin-top: 17%;
      }

      .dropdown {
        position: relative;
        display: inline-block;
      }

      .dropdown-content {
        display: none;
        position: absolute;
        background-color: #fcfcfc;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
      }

      .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
      }

      .dropdown-content a:hover {background-color: #eaeaea; color: #e02222;}

      .dropdown:hover .dropdown-content {display: block;}

      .dropdown:hover .dropbtn {background-color: #fcfcfc; color: #e02222;}
      .dropdown:hover .dropbtn2 {background-color: #fcfcfc; color: #e02222;}
      /* =======================================NEW CSS=========================================== */
      .navbar-nav li:hover > ul.dropdown-menu {
          display: block;
      }
      .dropdown-submenu {
          position:relative;
      }
      .dropdown-submenu > .dropdown-menu {
          top: 30;
          left: 10%;
          margin-top:-6px;
      }

      /* rotate caret on hover */
      .dropdown-menu > li > a:hover:after {
          text-decoration: underline;
          transform: rotate(-90deg);
      } 

    </style>

<!-- BEGIN TOP BAR -->
<div class="pre-header">
  <div class="container">
    <div class="row">
      <!-- BEGIN TOP BAR LEFT PART -->
      <div class="col-md-6 col-sm-6 additional-shop-info">
        <ul class="list-unstyled list-inline">
          <li>Contact Us : <i class="fa fa-phone"></i><span>+ 1821</span></li>
          <li>Look for : Ma'am Lanie</span></li>
          <li class="">
              <a href="<?php echo base_url('cashier_side_about') ?>">About Us</a>
          </li>
        </ul>
      </div>
      <!-- END TOP B  AR LEFT PART -->
      <!-- BEGIN TOP BAR MENU -->

      <div class="col-md-6 col-sm-6 additional-nav">
        <ul class="list-unstyled list-inline pull-right">
          <li><img alt="" class="img-square" src="http://<?php echo $photo_url; ?>" style="width: 25px;">&nbsp;&nbsp;<?php echo $username ?> [ <?php echo $emp_id ?> ]</li>
          <!-- <li><img alt="" class="img-square" src="http://<?php echo $photo_url; ?>" style="width: 25px;">&nbsp;&nbsp; [ <?php echo $emp_id ?> ]</li> -->
          <li><a href="<?php echo base_url() ?>logout_route">Log Out</a></li>
          <!-- <li><a href="<?php echo site_url('main_controller/log_out') ?>">Log Out</a></li> -->
          <!-- <li>
              <a class="btn btn-sm" href="<?php echo base_url('assets/guide/Cashier User Guide.pdf'); ?>" style="background-color: rgb(110, 110, 110); color: white" target="_blank">USER GUIDE</a>
          </li> -->
          <li class="">
              <a class="btn btn-sm" style="background-color: rgb(110, 110, 110); color: white" data-toggle="modal" href="#pdf">USER GUIDE</a>
          </li>
          <div class="modal fade" id="pdf" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="width: 70%">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">User's Guide</h4>
                </div>
                <div class="modal-body">
                  <iframe src="<?php echo base_url('assets/guide/Cashier User Guide.pdf'); ?>" width="100%" height="600"></iframe>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </ul>
      </div>
      <!-- END TOP BAR MENU -->
    </div>
  </div>
</div>
<!-- END TOP BAR -->
<!-- BEGIN HEADER -->

<div class="header">
  <div class="container">
    <!-- <div>
      <h2 style="margin-top: 1%; color: #e45000;"> CS CASHIER </h2>
    </div> -->
    <a class="site-logo" href="<?php echo site_url()?>"><img src="<?php echo base_url();?>assets/agc_logo/liquidation_logo.png" alt="Metronic FrontEnd"></a>
      <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>
    
        <div class="header-navigation pull-right font-transform-inherit">
              <ul>
                <!-- <li class="" id="denomination">
                  <div class="dropdown">
                    <button class="dropbtn">SALES REMITTANCE FORM</button>
                    <div class="dropdown-content">
                      <a href="<?php echo base_url() ?>cashier_cashform_route">CASH</a>
                      <a href="<?php echo base_url() ?>cashier_noncashform_route">NON CASH</a>                      
                    </div>
                  </div>
                </li>  -->
                <li class="dropdown-submenu" style="margin-top: 28px;">
                  <a class="dropdown-item dropdown-toggle" href="#" style="padding: 4px 26px 9px;">SALES REMITTANCE FORM</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                          <a class="dropdown-item dropdown-toggle" href="#">PARTIAL REMITTANCE</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo base_url() ?>cashier_cashform_route">CASH</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                          <a class="dropdown-item dropdown-toggle" href="#">FINAL REMITTANCE</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo base_url() ?>cashier_final_cashform_route">CASH</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url() ?>cashier_noncashform_route">NONCASH</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="" id="history">
                  <div class="dropdown">
                    <button class="dropbtn2">HISTORY FORM</button>
                    <div class="dropdown-content">
                      <a href="<?php echo base_url() ?>cashier_historyform_route">PENDING</a>
                      <a href="<?php echo base_url() ?>cashier_previous_historyform_route">PREVIOUS</a>
                    </div>
                  </div>
                </li>
              </ul>
        </div>

    <!-- END NAVIGATION -->
  </div>
</div>
<!-- Header END -->



<!-- <div class="topnav" id="myTopnav" style="margin-top: -1%; margin-left: 20%;">

  <button class="btn btn-primary waves-effect"><a href="<?php echo base_url() ?>cashier_cashform_route">
    CASH DENOMINATION FORM
  </a></button>

  <button class="btn btn-success waves-effect"><a href="<?php echo base_url() ?>cashier_noncashform_route">
    NON CASH DENOMINATION FORM
  </a></button>

  <button class="btn btn-info waves-effect"><a href="<?php echo base_url() ?>cashier_historyform_route">
    HISTORY
  </a></button>

  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>

</div>

<script>
  function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
      x.className += " responsive";
    } else {
      x.className = "topnav";
    }
  }
</script> -->