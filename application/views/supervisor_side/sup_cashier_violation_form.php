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

  <link href="<?php echo base_url() ?>assets/toggle/css/bootstrap-toggle.min.css" rel="stylesheet">

  <!-- Theme styles START -->
  <link href="<?php echo base_url(); ?>assets/global/css/components.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/frontend/layout/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/frontend/pages/css/portfolio.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/frontend/layout/css/style-responsive.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/frontend/layout/css/themes/red.css" rel="stylesheet" id="style-color">
  <link href="<?php echo base_url(); ?>assets/frontend/layout/css/custom.css" rel="stylesheet">
  <!-- Theme styles END -->

  <!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/clockface/css/clockface.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/datepicker3.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
<!-- END PAGE LEVEL STYLES -->

  <link href="<?php echo base_url(); ?>assets/global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/global/css/plugins-md.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
  <link href="<?php echo base_url(); ?>assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet">

<!-- ==============================================DATATABLE BUTTONS PLUGINS ========================================================== -->
    <!-- <link href="<?php echo base_url(); ?>datatables_buttons_plugins/buttons.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>datatables_buttons_plugins/jquery.dataTables.min.css" rel="stylesheet"> -->

    <!-- <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet"> -->
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
<!-- ================================================================================================================================== -->


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
}*/

.form-inline {  
  display: flex;
  flex-flow: row wrap;
  align-items: center;
}

.form-inline label {
  margin: 5px 10px 5px 0;
}

.form-inline input {
  vertical-align: middle;
  margin: 5px 10px 5px 0;
  padding: 10px;
  background-color: #fff;
  border: 1px solid #ddd;
}

.form-inline button {
  padding: 10px 20px;
  background-color: dodgerblue;
  border: 1px solid #ddd;
  color: white;
  cursor: pointer;
}

.form-inline button:hover {
  background-color: royalblue;
}

@media (max-width: 800px) {
  .form-inline input {
    margin: 10px 0;
  }
  
  .form-inline {
    flex-direction: column;
    align-items: stretch;
  }
}

#adjusted_viewing_tbody
{
    text-align: center;
}

</style>
</head>

<body class="corporate">

    <?php
    $this->load->view('supervisor_side/header');
    $this->load->view('supervisor_side/supervisor_js');
    ?>

<!-- =========================================================VIEWING CONTAINER================================================================== -->
<!-- <div class="page-container">
  <div class="page-content" style="background: #ffffff;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject uppercase">cashier violation</span>
                        </div>              
                    </div>
                         <form class="form-inline" style="margin-left: 35%;">
                          <label>CUTOFF DATE:</label>
                          <select type="text" id="cutoff_date" class="form-control" onchange="display_cashier_violation_js()" style="height: 35px; border: 1px solid #ddd;">
 
                          </select>
                          <label class="checkbox-inline">
                              CHECK ALL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="checkbox" id="checkAll" style="height: 25px; width: 25px; margin-top: -2px;">
                          </label>
                        </form>
                    <div class="portlet-body" id="divbody_cashier_violation_table">            
                    </div> 

                     <footer id="footer">
                      <div id="footer-content" style="margin-left: 60%;">
                         <label style="font-weight: bold; margin-left: -4%;">SHORT</label>
                         <button type="button" id="" style="background-color: red;" class="btn waves-effect"></button>
                          <label style="font-weight: bold;">OVER</label>
                         <button type="button" id="" style="background-color: green;" class="btn waves-effect"></button>
                         <button type="button" id="submit_violation" style="margin-left: 10%;" onclick="submit_violation_js()" class="btn btn-warning waves-effect">SUBMIT VIOLATION</button>
                      </div>
                    </footer>
                </div>  
            </div>  
        </div>    
    </div>
</div>
<div class="page-container">
  <div class="page-content" style="background: #ffffff;">
    <div class="container">
    
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject uppercase">violation forwarded</span>
                        </div>              
                    </div>
                    <form class="form-inline" style="margin-left: 30%;">
                      <label>FROM:</label>
                      <input type="date" onchange="display_forwarded_violation_js()" style="height: 35px;" id="dtfrom" value="<?php echo date('Y-m-d'); ?>">
                      <label>TO:</label>
                      <input type="date" onchange="display_forwarded_violation_js()" style="height: 35px;" id="dtto" value="<?php echo date('Y-m-d'); ?>">
                    </form>
                    <div class="portlet-body" id="divbody_forwarded_violation_table">                
                    </div> 
                     <footer id="footer">
                      <div id="footer-content" style="margin-left: 53%;">
                         <label style="font-weight: bold; margin-left: -4%;">SHORT</label>
                         <button type="button" id="" style="background-color: red;" class="btn waves-effect"></button>
                          <label style="font-weight: bold;">OVER</label>
                         <button type="button" id="" style="background-color: green;" class="btn waves-effect"></button>
                      </div>
                    </footer>

                </div>  
            </div>  
        </div>    
    </div>
</div> -->

<!-- ======================================= -->
<!--           TABBED CONTAINER              -->
<!-- ======================================= -->
<div class="page-container">
  <div class="page-content" style="background: #ffffff;">
    <div class="container">

      <!-- Tabs Header -->
      <ul class="nav nav-tabs" role="tablist" style="margin-bottom: 20px;">
        <li role="presentation" class="active">
          <a href="#tab_cashier_violation" aria-controls="tab_cashier_violation" role="tab" data-toggle="tab">
            CASHIER VIOLATION
          </a>
        </li>
        <li role="presentation">
          <a href="#tab_violation_forwarded" aria-controls="tab_violation_forwarded" role="tab" data-toggle="tab">
            VIOLATION FORWARDED
          </a>
        </li>
      </ul>

      <!-- Tabs Content -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="tab_cashier_violation">
          <div class="row">
            <div class="col-md-12">
              <div class="portlet light">
                <div class="portlet-title">
                  <div class="caption">
                    <span class="caption-subject uppercase">cashier violation</span>
                  </div>              
                </div>

                <form class="form-inline" style="margin-left: 35%;">
                  <label>CUTOFF DATE:</label>
                  <select type="text" id="cutoff_date" class="form-control" onchange="display_cashier_violation_js()" style="height: 35px; border: 1px solid #ddd;">
                  </select>
                </form>

                <div class="portlet-body" id="divbody_cashier_violation_table">
                </div> 

                <footer id="footer">
                  <div id="footer-content" style="margin-left: 60%;">
                    <label style="font-weight: bold; margin-left: -4%;">SHORT</label>
                    <button type="button" id="" style="background-color: red;" class="btn waves-effect"></button>
                    <label style="font-weight: bold;">OVER</label>
                    <button type="button" id="" style="background-color: green;" class="btn waves-effect"></button>
                    <button type="button" id="submit_violation" style="margin-left: 10%;" onclick="submit_violation_js()" class="btn btn-warning waves-effect">SUBMIT VIOLATION</button>
                  </div>
                </footer>
              </div>  
            </div>  
          </div>    
        </div>

        <!-- ==================== TAB 2: VIOLATION FORWARDED ==================== -->
        <div role="tabpanel" class="tab-pane fade" id="tab_violation_forwarded">
          <div class="row">
            <div class="col-md-12">
              <div class="portlet light">
                <div class="portlet-title">
                  <div class="caption">
                    <span class="caption-subject uppercase">violation forwarded</span>
                  </div>              
                </div>
                <form class="form-inline" style="margin-left: 30%;">
                  <label>FROM:</label>
                  <input type="date" onchange="display_forwarded_violation_js()" style="height: 35px;" id="dtfrom" value="<?php echo date('Y-m-d'); ?>">
                  <label>TO:</label>
                  <input type="date" onchange="display_forwarded_violation_js()" style="height: 35px;" id="dtto" value="<?php echo date('Y-m-d'); ?>">
                </form>
                <div class="portlet-body" id="divbody_forwarded_violation_table">
                </div> 
                <footer id="footer">
                  <div id="footer-content" style="margin-left: 53%;">
                    <label style="font-weight: bold; margin-left: -4%;">SHORT</label>
                    <button type="button" id="" style="background-color: red;" class="btn waves-effect"></button>
                    <label style="font-weight: bold;">OVER</label>
                    <button type="button" id="" style="background-color: green;" class="btn waves-effect"></button>
                  </div>
                </footer>
              </div>  
            </div>  
          </div>    
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ======================================= -->
<!--        END TABBED CONTAINER             -->
<!-- ======================================= -->

<!-- Cancel Violation Modal -->
<!-- Cancel Violation Modal -->
<div class="modal fade" id="cancelViolationModal" tabindex="-1" role="dialog" aria-labelledby="cancelViolationLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content border-danger shadow-lg">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="cancelViolationLabel">Cancel Violation</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="cancelViolationForm">
          <div class="container-fluid">
            <div class="row">
              <!-- Left Column -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Cashier Name</label>
                  <input type="text" id="cname" class="form-control" readonly>
                  <input type="hidden" id="vms_check" class="form-control" readonly>
                  <input type="hidden" id="cs_data_id" class="form-control" readonly>
                  <input type="hidden" id="offense_id" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label>Cashier ID</label>
                  <input type="text" id="cashier_id" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label>Daily Sales</label>
                  <input type="text" id="dsales" class="form-control" readonly>
                </div>
              </div>

              <!-- Right Column -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Business Unit</label>
                  <input type="text" id="bunit" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label>SOP</label>
                  <input type="text" id="sop" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label>SOP Type</label>
                  <input type="text" id="sop_type" class="form-control" readonly>
                </div>
                <!-- Requested By -->

              </div>
            </div>

            <hr>

            <!-- Violation Notice -->
            <div class="alert alert-warning">
              <i class="fa fa-exclamation-triangle"></i>
              This violation has already been generated by HRMS. Please state your reason for cancellation.
            </div>

              <div class="form-group">
                <label>Reason for Cancellation</label>
                <textarea id="cancel_reason" class="form-control" placeholder="Enter reason..." rows="4" required></textarea>
              </div>
                <div class="form-group">
                  <label>Requested By:</label>
                  <input type="text" id="requested_by" class="form-control" readonly>
                </div>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="confirmCancelViolation" onclick="validate_vio_cancel()">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>


<!-- ========================================================================================================================================= -->

<!-- ===================================================MASKMONEY PLUGINS============================================================== -->    
    <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/src/jquery.maskMoney.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
    <script src="<?php echo base_url(); ?>assets/frontend/layout/scripts/back-to-top.js" type="text/javascript"></script>
<!-- ================================================================================================================================= -->


<!-- =========================================================DATATABLE BUTTONS PLUGINS============================================================== -->
     <!-- <script src="<?php echo base_url(); ?>datatables_buttons_plugins/jquery-3.5.1.js" type="text/javascript"></script> -->
     <script src="<?php echo base_url(); ?>datatables_buttons_plugins/jquery.dataTables.min.js" type="text/javascript"></script>
     <script src="<?php echo base_url(); ?>datatables_buttons_plugins/dataTables.buttons.min.js" type="text/javascript"></script>
     <script src="<?php echo base_url(); ?>datatables_buttons_plugins/jszip.min.js" type="text/javascript"></script>
     <script src="<?php echo base_url(); ?>datatables_buttons_plugins/pdfmake.min.js" type="text/javascript"></script>
     <script src="<?php echo base_url(); ?>datatables_buttons_plugins/vfs_fonts.js" type="text/javascript"></script>
     <script src="<?php echo base_url(); ?>datatables_buttons_plugins/buttons.html5.min.js" type="text/javascript"></script>
     <script src="<?php echo base_url(); ?>datatables_buttons_plugins/buttons.print.min.js" type="text/javascript"></script>
<!-- ================================================================================================================================================ -->


    <script type="text/javascript">
      
      /*====================================================UPDATED CODE OF CUTOFF DATE DROPDOWN========================================================*/
      get_cutoff_date_js();
      // ==================================================================================
      display_forwarded_violation_js();

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
        var minDate = year + '-' + month + '-' + day;    
        $('#dtfrom').attr('max', maxDate);
        $('#dtto').attr('max', maxDate);
      });
      // ===================================================================================

/*====================================================OLD CODE OF CUTOFF DATE DROPDOWN========================================================*/
//         $(function(){
// /*=========================================CURRENT DATE============================================*/
//             var dateObj = new Date();
//             var month = String(dateObj.getUTCMonth() + 1).padStart(2, '0'); //months from 1-12
//             var month2 = String(dateObj.getUTCMonth() + 2).padStart(2, '0'); //months from 1-12
//             var shortMonth = dateObj.toLocaleString('en-us', { month: 'short' }); /* Jun */
//             var day = dateObj.getUTCDate();
//             var year = dateObj.getUTCFullYear();
//             var previous_year = dateObj.getUTCFullYear() - 1;
           
//             var date = new Date();
//             var current_month = date.getMonth();
//             var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
//             var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
            
// /*=========================================PREVIOUS DATE -1 ============================================*/
//             var dateObj1 = new Date();
//             var month1 = String(dateObj1.getUTCMonth()).padStart(2, '0'); //months from 1-12
//             var month3 = String(dateObj1.getUTCMonth() + 1).padStart(2, '0'); //months from 1-12
//             var day1 = dateObj1.getUTCDate();
//             var year1 = dateObj1.getUTCFullYear();
           
//             var date1 = new Date();
//             var firstDay1 = new Date(date1.getFullYear(), date1.getMonth(), 1);
//             var lastDay1 = new Date(date1.getFullYear(), date1.getMonth(), 0).getDate();
// /*====================================================================================================*/
            
//             if(day > 15)
//             {
//                 newdate0 = month + "-" + '01' + "-" + year;
//                 newdate01 = month + "-" + 15 + "-" + year;
//                 newdate = month + "-" + 16 + "-" + year;
//                 newdate2 = month + "-" + lastDay + "-" + year;
//                 // ============================================================================
//                 if(current_month == 0)
//                 {
//                   newdate4 = '12' + "-" + 16 + "-" + previous_year;
//                   newdate5 = '12' + "-" + lastDay1 + "-" + previous_year;
//                 }
//                 else
//                 {
//                   newdate4 = month3 + "-" + 16 + "-" + year1;
//                   newdate5 = month3 + "-" + lastDay1 + "-" + year1;
//                 }
//                 // ============================================================================
//                 $("#cutoff_date").append(new Option(newdate+' to '+newdate2));
//                 $("#cutoff_date").append(new Option(newdate0+' to '+newdate01));
//                 $("#cutoff_date").append(new Option(newdate4+' to '+newdate5));
//             }
//             else
//             {
//                 newdate = month + "-" + '01' + "-" + year;
//                 newdate2 = month + "-" + 15 + "-" + year;
//                 // ============================================================================
//                 if(current_month == 0)
//                 {
//                   newdate1 = '12' + "-" + '01' + "-" + previous_year;
//                   newdate3 = '12' + "-" + 15 + "-" + previous_year;
//                   newdate4 = '12' + "-" + 16 + "-" + previous_year;
//                   newdate5 = '12' + "-" + lastDay1 + "-" + previous_year;
//                 }
//                 else
//                 {
//                   newdate1 = month3 + "-" + '01' + "-" + year1;
//                   newdate3 = month3 + "-" + 15 + "-" + year1;
//                   newdate4 = month3 + "-" + 16 + "-" + year1;
//                   newdate5 = month3 + "-" + lastDay1 + "-" + year1;
//                 }
//                 // ============================================================================
//                 $("#cutoff_date").append(new Option(newdate+' to '+newdate2));
//                 $("#cutoff_date").append(new Option(newdate4+' to '+newdate5));
//                 $("#cutoff_date").append(new Option(newdate1+' to '+newdate3));
//             }
//              display_cashier_violation_js();
//         });

/*===============================================CHECK ALL CHECKBOX====================================================*/
       /* $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });*/
/*=====================================================================================================================*/
       
      
    </script>


    <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> -->
    <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

    <script src="<?php echo base_url(); ?>assets/toggle/js/bootstrap-toggle.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/clockface/js/clockface.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script src="<?php echo base_url(); ?>assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
    <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-mixitup/jquery.mixitup.min.js" type="text/javascript"></script>
    
    <script src="<?php echo base_url(); ?>assets/frontend/layout/scripts/layout.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/frontend/pages/scripts/portfolio.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/datepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/pages/scripts/components-pickers.js"></script>
    <script src="<?php echo base_url(); ?>assets/overlay/src/loadingoverlay.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/overlay/extras/loadingoverlay_progress/loadingoverlay_progress.min.js"></script>


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


