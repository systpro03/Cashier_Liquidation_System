    <style>
      .dropbtn {
        /*background-color: #04AA6D;*/
        background-color: #fff;
        color: black;
        padding: 10px;
        /*font-size: 16px;*/
        border: none;
        margin-top: 17%;
      }

      .dropbtn1 {
        /*background-color: #04AA6D;*/
        background-color: #fff;
        color: black;
        padding: 10px;
        /*font-size: 16px;*/
        border: none;
        margin-top: 21%;
      }

      .dropbtn2 {
        /*background-color: #04AA6D;*/
        background-color: #fff;
        color: black;
        padding: 10px;
        /*font-size: 16px;*/
        border: none;
        margin-top: 23%;
      }

      .dropbtn3 {
        /*background-color: #04AA6D;*/
        background-color: #fff;
        color: black;
        padding: 10px;
        /*font-size: 16px;*/
        border: none;
        margin-top: 11%;
      }

      .dropbtn4 {
        /*background-color: #04AA6D;*/
        background-color: #fff;
        color: black;
        padding: 10px;
        /*font-size: 16px;*/
        border: none;
        margin-top: 32%;
      }

      .dropbtn5 {
        /*background-color: #04AA6D;*/
        background-color: #fff;
        color: black;
        padding: 10px;
        /*font-size: 16px;*/
        border: none;
        margin-top: 21%;
      }

      .dropbtn6 {
        /*background-color: #04AA6D;*/
        background-color: #fff;
        color: black;
        padding: 10px;
        /*font-size: 16px;*/
        border: none;
        margin-top: 32%;
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
      .dropdown:hover .dropbtn1 {background-color: #fcfcfc; color: #e02222;}
      .dropdown:hover .dropbtn2 {background-color: #fcfcfc; color: #e02222;}
      .dropdown:hover .dropbtn3 {background-color: #fcfcfc; color: #e02222;}
      .dropdown:hover .dropbtn4 {background-color: #fcfcfc; color: #e02222;}
      .dropdown:hover .dropbtn5 {background-color: #fcfcfc; color: #e02222;}
      .dropdown:hover .dropbtn6 {background-color: #fcfcfc; color: #e02222;}

      #adjustment_link:hover {
        color: #e02222;
      }

      #masterfile_link:hover {
        color: #e02222;
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
                            <a href="<?php echo base_url('liquidation_side_about') ?>">About Us</a>
                        </li>
                    </ul>
                </div>
                <!-- END TOP BAR LEFT PART -->
                <!-- BEGIN TOP BAR MENU -->
               
                <div class="col-md-6 col-sm-6 additional-nav">
                    <ul class="list-unstyled list-inline pull-right">                        
                        <li><img alt="" class="img-square" src="http://<?php echo $photo_url;?>" style="width: 25px;">&nbsp;&nbsp;<?php echo $username?> [ <?php echo $emp_id?> ]</li>
                               <?php
                if($emp_id == '15815-2013' || $emp_id == '06025-2015' || $emp_id == '06025-2015' || $emp_id == '20426-2013')
                {
                  ?>
                    
                    <li><a href="<?php echo site_url('main_controller/old_system')?>">ADJUSTMENT</a></li>
                   
                  <?php
                }
                ?>
                        <!-- <li><a href="<?php echo site_url('main_controller/old_system')?>">OLD SYSTEM</a></li> -->
                        <li><a href="<?php echo site_url('main_controller/log_out')?>">Log Out</a></li>
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
                                <iframe src="<?php echo base_url('assets/guide/Liq_Officer_User Guide.pdf'); ?>" width="100%" height="600"></iframe>
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
        <a class="site-logo" href="<?php echo site_url()?>"><img src="<?php echo base_url();?>assets/agc_logo/liquidation_logo.png" alt="Metronic FrontEnd"></a>

        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

        <!-- BEGIN NAVIGATION -->
        <!-- Mifaña, April Bunayog(43251-2013) | Abrio, Sharlyn Bautista(02930-2017) | Tuyor, Emily Bayron(19043-2018) | Montederamos, Ma. Re Ann Daguplo(07483-2015)-->
        <!-- Lebot, Jonalyn Sarat(10494-2013) | Sausa, Novelyn Lumansoc(26869-2013)-->
        <?php if($emp_id == '43251-2013' || $emp_id == '02930-2017' || $emp_id == '19043-2018' || $emp_id == '07483-2015' ||
                 $emp_id == '10494-2013' || $emp_id == '26869-2013')
        {
            ?>
                <div class="header-navigation pull-right font-transform-inherit">
                  <ul>
                    <li id="dashboard">
                      <a href="<?php echo site_url()?>">
                        Home                 
                      </a>
                    </li> 
                    <li id="den_form">
                      <a href="<?php echo site_url('main_controller/bu_denomination_form')?>">
                            Denomination Form             
                      </a>
                    </li>               
                     <li class="" id="demo_id">
                      <a href="<?php echo site_url('main_controller/demo_con')?>">
                            [ SYSTEM DEMO ]      
                      </a>
                    </li> 
                  <!--   <li class="" id="report_id">
                      <a href="<?php echo site_url('main_controller/report_con')?>">
                            Report     
                      </a>
                    </li>  -->         
                  
                  </ul>
                </div>
            <?php
        }
        else
        {
          ?>
              <div class="header-navigation pull-right font-transform-inherit">
              <ul>
                <li id="den_form">
                  <div class="dropdown">
                    <button class="dropbtn3">Cashier Sales Remittance</button>
                    <div class="dropdown-content">
                      <a href="<?php echo base_url() ?>liq_domination_route">Pending</a>
                      <a href="<?php echo base_url() ?>cashier_partial_remitted_route">Partial Remitted</a>
                      <a href="<?php echo base_url() ?>liq_transferred_den_route">Final Remitted</a>
                    </div>
                  </div>
                </li> 
                <li class="" id="deduction">
                  <div class="dropdown">
                    <button class="dropbtn2">Deduction</button>
                    <div class="dropdown-content">
                      <a href="<?php echo site_url('main_controller/deduction_con')?>">Set-up Deduction</a>
                      <a href="<?php echo site_url('main_controller/deduction_for_con')?>">Deductions Forwarded</a>
                    </div>
                  </div>
                </li> 
                <li class="" id="cashier_access">
                  <div class="dropdown">
                    <button class="dropbtn">Cashier Access</button>
                    <div class="dropdown-content">
                      <a href="<?php echo base_url() ?>setup_cashier_login_route">Set-up Log-in</a>
                      <a href="<?php echo base_url() ?>setup_cashier_access_route">Set-up Access</a>
                      <a href="<?php echo base_url() ?>setup_cashier_counter_route">Set-up Assigned Counter</a>
                      <a href="<?php echo base_url() ?>advance_setup_cashier_counter_route">Advance Set-up Assigned Counter</a>
                    </div>
                  </div>
                </li>
                <li class="" id="remittance">
                  <div class="dropdown">
                    <button class="dropbtn1">Remittance</button>
                    <div class="dropdown-content">
                      <a href="<?php echo base_url() ?>received_cash_route">Received Cash Sales</a>
                      <a href="<?php echo base_url() ?>partial_remitted_cash_route">Batch Remitted Cash Sales</a>
                    </div>
                  </div>
                </li> 
                <li class="" id="adjustment">
                  <div class="dropdown">
                    <button class="dropbtn5">Adjustment</button>
                    <div class="dropdown-content">
                      <a href="<?php echo base_url() ?>adjustment_cash_route">Pending Cashier Remittance</a>
                      <a href="<?php echo base_url() ?>adjustment_noncash_route">Pending NonCash Remittance</a>
                      <a href="<?php echo base_url() ?>adjustment_posted_route">Posted Cashier Remittance</a>
                      <a href="<?php echo base_url() ?>adjustment_posted_zero_rs_route">Posted Zero Registered Sales</a>
                      <a href="<?php echo base_url() ?>adjustment_sales_date_route">Sales Date Adjustment</a>
                    </div>
                  </div>
                </li> 
                <!-- <li class="" id="adjustment">
                  <div class="dropdown">
                      <a id="adjustment_link" style="text-decoration: none;" href="<?php echo base_url() ?>liq_adjustment_route">
                        <div style="margin-top: 9%;">
                          <span class="badge badge-default" id="badge_notif_counter" style="background-color: #E02222; margin-bottom: -7%;">
                            <?php 
                              echo $badge_notif_counter;
                            ?>
                          </span>
                        </div>
                        <i class="" style="font-style: normal;">🔔</i> Adjustment      
                      </a>
                  </div>
                </li>  -->
                <li class="" id="report">
                  <div class="dropdown">
                    <button class="dropbtn4">Report</button>
                    <div class="dropdown-content">
                      <a href="<?php echo base_url() ?>end_of_day_report_route">End Of Day</a>
                      <a href="<?php echo base_url() ?>productivity_report_route">Automated Cashier's Productivity</a>
                      <a href="<?php echo base_url() ?>productivity_report_all_cashier_route">Cashier's Productivity</a>
                    </div>
                  </div>
                </li> 
                <li class="" id="masterfile">
                  <div class="dropdown">
                    <div style="margin-top: 46%;">
                      <a id="masterfile_link" style="text-decoration: none;" href="<?php echo base_url() ?>liq_masterfile_route">
                        Masterfile     
                      </a>
                    </div>
                  </div>
                </li>  
                <li class="" id="history">
                  <div class="dropdown">
                    <button class="dropbtn6">History</button>
                    <div class="dropdown-content">
                      <a href="<?php echo base_url() ?>deleted_pending_cash_route">Deleted Pending Cash</a>
                      <a href="<?php echo base_url() ?>deleted_posted_route">Deleted Posted Denomination</a>
                      <a href="<?php echo base_url() ?>view_deleted_remitted_cash_module_route">Deleted Remitted Cash Denomination</a>
                      <a href="<?php echo base_url() ?>adjusted_posted_zero_rs_route">Adjusted Zero Registered Sales</a>
                      <a href="<?php echo base_url() ?>adjusted_sales_date_route">Adjusted Sales Date</a>
                    </div>
                  </div>
                </li>     
              </ul>
            </div>
          <?php
        }

        ?>
        <!-- END NAVIGATION -->
      </div>
    </div>
    <!-- Header END -->

