


  <!-- BEGIN PAGE LEVEL STYLES -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/select2/select2.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
  <!-- END PAGE LEVEL STYLES -->



<style type="text/css">
  
  table.dataTable td.dataTables_empty 
  {
    text-align: center;    
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

  td {
        text-align: center;
    }

    label{
        font-size: 15px;
        display: block;
    }

/*=========================PENDING MODAL STYLE==================================*/
* {
  box-sizing: border-box;
}

/* Create three equal columns that floats next to each other */
.column {
  float: left;
  width: 33.33%;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Important part */
.modal-dialog{
    overflow-y: initial !important
}
.modal-body{
    /*height: 80vh;*/
    overflow-y: auto;
}
/*=============================END==============================================*/

  input
  {
      display: block;
  }

  input[type="checkbox"]
  {
    margin-top: -1px;
    zoom: 1.9;
  }

  .swal2-container
  {
      z-index: 300000!important;
  }
  
</style>

<!-- modal -->
<div class="modal" tabindex="-1" id="pending_modal" style="margin-left: -53%;">
  <div class="modal-dialog">
    <div class="modal-content" id="pending_modalcontent" style="width: 220%;">
      <div class="modal-header">
        <center><h5 class="modal-title" id="pending_modaltitle" style="font-weight: bold; font-size: 15px;">Cashier Denomination Details</h5></center>
      </div>
      <!-- <label id="cutoff_date_txt" style="font-weight: bold;">CUT OFF DATE</label> -->
      <label hidden id="trno_txt" style="font-weight: bold;"></label>
      <div class="modal-body row" id="pending_modalbody" style="height: 600px;">

        <!-- ===========================================CASH DENOMINATION FORM========================================= -->
          <div class="column">

            <form>
              <center>
                <label id="pending_cashlbl" style="font-size: 15px; margin-top: -1%; font-weight: bold;">CASH FORM</label>
                <label hidden id="empid_cashlbl" style="font-size: 15px; margin-top: -1%; font-weight: bold;"></label>
                <label id="cmodalcashremit_type" style="font-weight: bold;"></label>
                <div id="borrowed_div">
                  <!-- =================================================== -->
                </div>
              </center>
            </form>

          <div class="table-scrollable" id="liq_cashdendiv">
            <table class="table table-striped table-bordered table-hover display">
              <thead>
                <tr>

                  <th style="font-weight: bold; font-size: 15px;" width="35%">
                    <center>DENOMINATION
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="25%">
                    <center>QUANTITY
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="40%">
                    <center>AMOUNT
                  <th width="15%">
                      <input id="thpcm_checkbox" type="checkbox">
                  </th>
              </thead>
                <form name="liq_cashdenform" id="liq_cashdenform">
                    <tbody id="liq_cashtbody">
                      
                    </tbody>
                </form>
            </table>   
          </div>
          <footer>
              <div id="footer-content">
                <div style="float: right;">
                  <button type="button" style="color: white; background-color: navy;" id="edit_cash_pos_btn" class="btn waves-effect" onclick="enable_edit_cash_pos_js()">ENABLE EDIT COUNTER ✏️</button>
                  <button type="button" id="cash_confirm_btn" class="btn btn-warning waves-effect" onclick="confirm_pcpmodal_js()">CONFIRM ✔️</button>
                </div>
                <br><br>
                <div style="float: right; margin-top: 2%;">
                  <!-- <button type="button" id="refresh_cash_btn" style="background-color: blueviolet; color: white;" class="btn waves-effect" onclick="refresh_pendingmodal()">↻</button> -->
                  <button type="button" id="edit_borrowed_btn" class="btn btn-success waves-effect" onclick="enable_cashier_edit_borrowed_js()">ENABLE EDIT BORROWED ✏️</button>
                  <button type="button" id="cancel_borrowed_btn" class="btn btn-danger waves-effect" onclick="cancel_borrowed_cashpending_modal_js()">CANCEL BORROWED ❌</button>
                </div>
                <br><br>
                <div style="float: right; margin-top: 2%;">
                  <button type="button" id="refresh_cash_btn" style="background-color: blueviolet; color: white;" class="btn waves-effect" onclick="refresh_pendingmodal()">↻</button>
                  <button type="button" id="edit_cashier_den_btn" style="background-color: brown; color: white;" class="btn waves-effect" onclick="enable_cashier_edit_den_js()">ENABLE CASHIER EDIT DENOMINATION ✏️</button>
                </div>
              </div>
          </footer> 
          </div>                                    
        <!-- ===========================================END CASH DENOMINATION FORM====================================</FORM> -->

         <!-- ===========================================NONCASH DENOMINATION FORM========================================= -->
          <div class="column">

            <form>
              <center>
                <label id="pending_ncashlbl" style="font-size: 15px; margin-top: -1%; font-weight: bold;">NONCASH FORM</label>
                <label hidden id="noncash_empid"></label>
                <div id="noncash_borrowed_div">
                  <!-- =================================================== -->
                </div>
              </center>
            </form>

          <div class="table-scrollable">
            <table class="table table-striped table-bordered table-hover display">
              <thead>
                <tr>
                  <th style="font-weight: bold; font-size: 15px;" width="50%">
                    <center>DENOMINATION
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="20%">
                    <center>QUANTITY
                  </th>
                  <th style="font-weight: bold; font-size: 15px;" width="30%">
                    <center>AMOUNT
                  </th>
                  <th width="15%">
                      <input id="thpncm_checkbox" type="checkbox">
                  </th>
                  </tr>
              </thead>
                <form name="liq_ncashdenform" id="liq_ncashdenform">
                    <tbody id="liq_ncashtbody">
                      
                    </tbody>
                </form>
            </table>
          </div>
          <footer>
              <div id="footer-content">
                <div style="float: right;">
                  <button type="button" style="color: white; background-color: navy;" id="edit_noncash_pos_btn" class="btn waves-effect" onclick="enable_edit_noncash_pos_js()">ENABLE EDIT COUNTER ✏️</button>
                  <button type="button" id="add_mop_btn" style="background-color: forestgreen; color: white;" class="btn waves-effect" onclick="enable_add_mop_js()">ENABLE ADD MOP ➕</button>
                </div>
                <br><br>
                <div style="float: right; margin-top: 2%;">
                  <button type="button" id="edit_borrowed_ncbtn" class="btn btn-success waves-effect" onclick="enable_cashier_edit_noncashborrowed_js()">ENABLE EDIT BORROWED ✏️</button>
                  <button type="button" id="cancel_borrowed_ncbtn" class="btn btn-danger waves-effect" onclick="cancel_borrowed_noncashpending_modal_js()">CANCEL BORROWED ❌</button>
                </div>
                <br><br>
                <div style="float: right; margin-top: 2%;">
                  <button type="button" id="refresh_noncash_btn" style="background-color: blueviolet; color: white;" class="btn waves-effect" onclick="refresh_noncashpendingmodal()">↻</button>
                  <button type="button" id="edit_cashier_ncden_btn" style="background-color: brown; color: white;" class="btn waves-effect" onclick="enable_cashier_edit_noncashden_js()">ENABLE CASHIER EDIT DENOMINATION ✏️</button>
                </div>
              </div>
          </footer> 
          </div>                               
        <!-- ===========================================END NONCASH DENOMINATION FORM==================================== -->

        <!-- ===========================================VARIANCE FORM========================================= -->
          <div class="column">

            <form>
              <center><label id="pending_variancelbl" style="font-size: 15px; margin-top: -1%; font-weight: bold;">VARIANCE FORM</label></center>
            </form>

            <div class="table-scrollable" id="liq_variancediv">
              <table class="table table-striped table-bordered table-hover display">
                <thead>
                  <tr>
                    <th style="font-size: 15px; width: 50%; font-weight: bold;">
                      <center>DENOMINATION
                    </th>
                    <th style="font-size: 15px; width: 50%; font-weight: bold;">
                      <center>AMOUNT
                    </th>
                  </tr>
                </thead>
                  <form name="liq_varianceform" id="liq_varianceform">
                      <tbody id="liq_variancetbody">
                        
                      </tbody>
                  </form>
              </table>
            </div>
          </div>                               
        <!-- ===========================================END VARIANCE FORM====================================</FORM> -->

    </div>

      <div class="modal-footer" id="pending_modalfooter">
        <button type="button" disabled style="color: white; background-color: brown;" id="print_cashierden_btn" class="btn waves-effect">PRINT 🖨️</button>
        <button type="button" id="submit_cashierden_btn" class="btn btn-warning waves-effect" onclick="submit_cashierden_js()">SUBMIT ✔️</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE ❌</button>
      </div>
    </div>
 <!-- end of modal -->




    <script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/src/jquery.maskMoney.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
    <script src="<?php echo base_url();?>assets/frontend/layout/scripts/back-to-top.js" type="text/javascript"></script>


    <script type="text/javascript">
        
      window.io = {
            open: function(verb, url, data, target){
                var form = document.createElement("form");
                form.action = url;
                form.method = verb;
                form.target = target || "_self";
                if (data) {
                    for (var key in data) {
                        var input = document.createElement("textarea");
                        input.name = key;
                        input.value = typeof data[key] === "object"
                            ? JSON.stringify(data[key])
                            : data[key];
                        form.appendChild(input);
                    }

                }
                form.style.display = 'none';
                document.body.appendChild(form);
                form.submit();
                document.body.removeChild(form);
            }
        };

        $('#print_cashierden_btn').click(function()
        {
                var trno = $("#trno_txt").text();
                var cashier_id = $("#empid_cashlbl").text();
                if(cashier_id == '')
                {
                  cashier_id = $("#noncash_empid").text();
                }
                io.open('POST', '<?php echo base_url('print_cashierden_route'); ?>', { trno: trno, cashier_id: cashier_id },'_blank');       
        });    
        /*======================================auto comma in number=================================================================*/
        $(".d_amount").maskMoney({thousands:',', decimal:'.', allowZero: true, suffix: ' '});
        /*=============================================================================================================================*/

    </script>

      <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>



