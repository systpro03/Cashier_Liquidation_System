    <!-- BEGIN TOP BAR -->
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <!-- BEGIN TOP BAR LEFT PART -->
                <div class="col-md-6 col-sm-6 additional-shop-info">
                    <ul class="list-unstyled list-inline">
                        <li>Contact Us : <i class="fa fa-phone"></i><span>+ 1821</span></li>
                        <li>Look for : Ma'am Sarah / Allaiza</span></li>
                    </ul>
                </div>
                <!-- END TOP BAR LEFT PART -->
                <!-- BEGIN TOP BAR MENU -->
                <div class="col-md-6 col-sm-6 additional-nav">
                    <ul class="list-unstyled list-inline pull-right">                        
                        <li><img alt="" class="img-square" src="http://<?php echo $photo_url;?>" style="width: 25px;">&nbsp;&nbsp;<?php echo $username?> [ <?php echo $emp_id?> ]</li>
                        <li><a href="<?php echo site_url('main_controller/old_system')?>">OLD SYSTEM</a></li>
                        <li><a href="<?php echo site_url('main_controller/log_out')?>">Log Out</a></li>
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
        <a class="site-logo" href="<?php echo site_url()?>"><img src="<?php echo base_url();?>assets/agc_logo/hr.png" alt="Metronic FrontEnd"></a>

        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

        <!-- BEGIN NAVIGATION -->
        <div class="header-navigation pull-right font-transform-inherit">
          <ul>
            <li id="dashboard">
              <a href="<?php echo site_url()?>">
                Home                 
              </a>
            </li> 
    <!--         <li id="cs_transaction">
              <a href="<?php echo site_url('main_controller/cashier_transaction')?>">
                    Cashier Transaction             
              </a>
            </li>  -->
            <li class="" id="cs_violation">
              <a href="<?php echo site_url('main_controller/cashier_violation')?>">
                    Cashier Violation        
              </a>
            </li> 
            <li class="" id="cs_violation_for">
              <a href="<?php echo site_url('main_controller/cashier_violation_forwarded')?>">
                    Violation Forwarded     
              </a>
            </li> 
            <li class="" id="demo_id">
              <a href="<?php echo site_url('main_controller/system_demo')?>">
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
        <!-- END NAVIGATION -->
      </div>
    </div>
    <!-- Header END -->