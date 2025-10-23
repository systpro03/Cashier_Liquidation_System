

<style type="text/css">
	
	  .swal2-container
    {
        z-index: 300000!important;
    }

    .no-arrows::-webkit-inner-spin-button, 
    .no-arrows::-webkit-outer-spin-button { 
      -webkit-appearance: none; 
      margin: 0; 
    }

</style>


<!-- =================================================cash modal======================================================= -->
    <div class="modal fade" tabindex="-1" id="cash_den_modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="cash_den_contentmodal" style="width: 100%;">
          <div class="modal-header" id="cash_den_headermodal">
            <h5 class="modal-title"><center style="font-weight: bold;">Cash Denomination of: &nbsp;<span id="cashier_name"></span></center></h5>
            <h4 class="modal-title"><center style="font-weight: bold;"><span id="tr"></span></center></h4>
          </div><br>
          
          <span hidden id="cashier_info"></span>
          <center><label style="font-weight: bold;"><span id="remittance_type"></span> REMITTANCE</label></center>
          <div class="modal-body">
            <div id="cash_den_bodymodal">
                
            </div>
          </div>
      
          <div class="modal-footer" style="margin-top: -3%;">
            <button type="button" class="btn btn-warning waves-effect" onclick="update_cash_den_js()">UPDATE ✔️</button>
            <button type="button" class="btn btn-primary waves-effect" onclick="close_cash_den_modal_js()">CLOSE ❌</button>
          </div>

        </div>
      </div>
    </div>
<!-- ===============================================end of cash modal======================================================= -->

<!-- =================================================noncash modal======================================================= -->
<div class="modal fade" tabindex="-1" id="noncash_den_modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="noncash_den_contentmodal">
      <div class="modal-header" id="noncash_den_headermodal">
        <h5 class="modal-title"><center style="font-weight: bold; font-style: uppercase;">Non Cash Denomination of: &nbsp;<span id="noncash_cashier_name"></span></center></h5>
      </div>
      
      <span hidden id="noncash_cashier_info"></span>
      <span hidden id="mop_array"></span>
      <div class="modal-body">
        <div id="noncash_den_bodymodal">
            
        </div>
      </div>

      <div class="modal-footer" style="margin-top: -3%;">
        <button type="button" class="btn btn-primary waves-effect" onclick="close_noncash_den_modal_js()">CLOSE ❌</button>
      </div>

    </div>
  </div>
  </div>
<!-- ===============================================end of noncash modal======================================================= -->

<!-- =================================================terminal_no modal======================================================= -->
<div class="modal fade" tabindex="-1" id="terminal_no_modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="terminal_no_contentmodal" style="width: 100%;">
      <div class="modal-header" id="terminal_no_headermodal">
        <h5 class="modal-title"><center style="font-weight: bold;">Terminal No. & Registered Sales of: &nbsp;<span id="terminal_no_cashier_name"></span></center></h5>
      </div>
      
      <span hidden id="terminal_no_cashier_info"></span>
      <div class="modal-body">
        <div>
          <span hidden id="total_sales"></span>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <th width="35%" style="text-align: center; vertical-align: middle;">Terminal No.</th>
              <th width="28%" style="text-align: center; vertical-align: middle;">Total Sales.</th>
              <th width="25%" style="text-align: center; vertical-align: middle;">Registered Sales</th>
              <th width="28%" style="text-align: center; vertical-align: middle;">Amount</th>
              <th width="28%" style="text-align: center; vertical-align: middle;">Type</th>
              <th width="20%" style="text-align: center; vertical-align: middle;">Discount</th>
              <th width="20%" style="text-align: center; vertical-align: middle;">Transaction Count</th>
            </thead>
            <tbody>
              <td><center><select id="terminal_no" class="form-select form-control"></select></center></td>
              <td><input style="text-align: right; width: 100%;" type="text" class="form-control cash_input" id="total_sales1">
              <td><input style="text-align: right; width: 100%;" type="text" class="form-control cash_input" id="registered_sales"><span hidden id="old_registered_sales"></span></td>
              <td><input style="text-align: right; width: 100%;" type="text" class="form-control cash_input" id="short" disabled><span hidden id="old_short"></span></td>
              <td><input style="text-align: center; width: 50px;" type="text" class="form-control cash_input" id="type" disabled><span hidden id="old_type"></span></td>
              <td><input style="text-align: right; width: 100%;" type="text" class="form-control cash_input" id="discount"><span hidden id="old_discount"></span></td>
              <td><input style="text-align: right; width: 100%;" type="number" class="form-control no-arrows" id="tr_count"><span hidden id="old_tr_count"></span></td>
            </tbody>
          </table>
        </div>
      </div>
  
      <div class="modal-footer" style="margin-top: -3%;">
        <button type="button" class="btn btn-warning waves-effect" onclick="update_terminal_js()">UPDATE ✔️</button>
        <button type="button" class="btn btn-primary waves-effect" onclick="close_terminal_no_modal_js()">CLOSE ❌</button>
      </div>

    </div>
  </div>
</div>
<!-- ===============================================end of terminal_no modal======================================================= -->

<!-- =================================================transfer_noncash modal======================================================= -->
<div class="modal fade" tabindex="-1" id="transfer_noncash_den_modal">
  <div class="modal-dialog">
    <div class="modal-content" id="transfer_noncash_den_contentmodal" style="width: 100%;">
      <div class="modal-header" id="transfer_noncash_den_headermodal">
        <h5 class="modal-title"><center style="font-weight: bold;">Transfer Mode of Payment from ( <span id="origin_mop"></span> )</center></h5>
      </div>
      
      <span hidden id="mop_info"></span>
      <div class="modal-body">
        <div id="transfer_noncash_den_bodymodal">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <th width="55%" style="text-align: center;">Transfer Mode of Payment to</th>
                <th width="15%" style="text-align: center;">Quantity</th>
                <th width="30%" style="text-align: center;">Amount</th>
              </thead>
              <tbody>
                <td><center><select id="transfer_mop" class="form-control"></select></center></td>
                <td><input style="text-align: right; width: 100%;" type="number" class="form-control no-arrows" min="1" id="transfer_qty"></td>
                <td><input style="text-align: right; width: 100%;" type="text" onkeyup="validate_transfer_amount_js()" class="form-control transfer_amount" id="transfer_amount"></td>
              </tbody>
            </table>
        </div>
      </div>

      <div class="modal-footer" style="margin-top: -3%;">
        <button type="button" class="btn btn-warning waves-effect" onclick="transfer_mop_js()">TRANSFER 💸</button>
        <button type="button" class="btn btn-primary waves-effect" onclick="close_transfer_noncash_den_modal_js()">CLOSE ❌</button>
      </div>

    </div>
  </div>
  </div>
<!-- ===============================================end of transfer_noncash modal======================================================= -->

<!-- =================================================sales date modal======================================================= -->
<div class="modal fade" tabindex="-1" id="sales_date_modal">
  <div class="modal-dialog">
    <div class="modal-content" id="sales_date_contentmodal" style="width: 100%;">
      <div class="modal-header" id="sales_date_headermodal">
        <h5 class="modal-title"><center style="font-weight: bold;">Change Sales Date from <span id="sales_date_header"></span></center></h5>
      </div>
      
      <span hidden id="sales_date_info"></span>
      <div class="modal-body">
        <div id="sales_date_bodymodal">
            <center><input type="date" id="sales_date" class="form-control" style="width: 60%; text-align: center"></center>
        </div>
      </div>

      <div class="modal-footer" style="margin-top: -3%;">
        <button type="button" class="btn btn-warning waves-effect" onclick="update_sales_date_js()">UPDATE ✔️</button>
        <button type="button" class="btn btn-primary waves-effect" onclick="close_sales_date_modal_js()">CLOSE ❌</button>
      </div>

    </div>
  </div>
  </div>
<!-- ===============================================end of sales date modal======================================================= -->

<!-- =================================================location modal======================================================= -->
<div class="modal fade" tabindex="-1" id="location_modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="location_contentmodal" style="width: 100%;">
      <div class="modal-header" id="location_headermodal">
        <h5 class="modal-title"><center style="font-weight: bold;">Change Location from: <span id="location_header"></span></center></h5>
      </div>

      <span hidden id="location_info"></span>
      <div class="modal-body">
        <div id="location_bodymodal">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th width="30%" style="text-align: center;">DEPARTMENT</th>
                  <th width="30%" style="text-align: center;">SECTION</th>
                  <th width="30%" style="text-align: center;">SUB SECTION</th>
                  <th width="10%" style="text-align: center;">BORROWED</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><select style="width: 100%;" id="department" class="form-control" onchange="get_section_js()"></select></td>
                  <td><select style="width: 100%;" id="section" class="form-control" onchange="get_sub_section_js()"></select></td>
                  <td><select style="width: 100%;" id="sub_section" class="form-control"></select></td>
                  <td>
                    <select style="width: 100%; text-align: center;" id="borrowed" class="form-control">
                      <option id="borrowed_yes">YES</option>
                      <option id="borrowed_no">NO</option>
                    </select>
                  </td>
                </tr>
              </tbody>
            </table>
        </div>
      </div>

      <div class="modal-footer" style="margin-top: -3%;">
        <button type="button" class="btn btn-warning waves-effect" onclick="update_location_js()">UPDATE ✔️</button>
        <button type="button" class="btn btn-primary waves-effect" onclick="close_location_modal_js()">CLOSE ❌</button>
      </div>

    </div>
  </div>
  </div>
<!-- ===============================================end of location modal======================================================= -->

<!-- =================================================batch remittance modal======================================================= -->
<div class="modal fade" tabindex="-1" id="batch_remittance_modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="batch_remittance_contentmodal" style="width: 100%;">
      <div class="modal-header" id="batch_remittance_headermodal">
        <h5 class="modal-title"><center style="font-weight: bold;">Batch Remittance History of: <span id="cashier_name_header"></span></center></h5>
      </div>

      <span hidden id="batch_remittance_info"></span>
      <div class="modal-body">
        <div id="batch_remittance_bodymodal">
           
        </div>
      </div>

      <div class="modal-footer" style="margin-top: -3%;">
        <button type="button" class="btn btn-primary waves-effect" onclick="close_batch_remittance_modal_js()">CLOSE ❌</button>
      </div>

    </div>
  </div>
  </div>
<!-- ===============================================end of batch remittance modal======================================================= -->

<script type="text/javascript">
	
  function close_cash_den_modal_js()
  {
    $('#cash_den_modal').modal('toggle');
  }

  function close_noncash_den_modal_js()
  {
    $('#noncash_den_modal').modal('toggle');
  }

  function close_terminal_no_modal_js()
  {
    $('#terminal_no_modal').modal('toggle');
  }

  function close_transfer_noncash_den_modal_js()
  {
    $('#transfer_noncash_den_modal').modal('toggle');
  }

  function close_sales_date_modal_js()
  {
    $('#sales_date_modal').modal('toggle');
  }

  function close_location_modal_js()
  {
    $('#location_modal').modal('toggle');
  }

  function close_batch_remittance_modal_js()
  {
    $('#batch_remittance_modal').modal('toggle');
  }

  $("#transfer_qty").keydown(function(event) {
      if (event.key === "e" || event.key === "E" || event.key === "+" || event.key === "-" || event.key === ".") {
      event.preventDefault();
      }
  });

  $("#tr_count").keydown(function(event) {
      if (event.key === "e" || event.key === "E" || event.key === "+" || event.key === "-" || event.key === ".") {
      event.preventDefault();
      }
  });

  $(".cash_input").maskMoney({thousands:",", decimal:".", allowZero: true, suffix: " "});
  $(".transfer_amount").maskMoney({thousands:",", decimal:".", allowZero: true, suffix: " "});
</script>

