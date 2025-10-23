



<style type="text/css">
	
	  .swal2-container
    {
        z-index: 300000!important;
    }

</style>


<!-- =================================================adjustment modal======================================================= -->
    <div class="modal" tabindex="-1" id="adjustment_modal" style="margin-left: -200px;">
      <div class="modal-dialog">
        <div class="modal-content" id="adjustment_contentmodal" style="width: 126%;">
          <div class="modal-header" id="adjustment_headermodal">
            <h5 class="modal-title"><center style="font-weight: bold;">NAVISION ADJUSTMENT</center></h5>
          </div>

          <input hidden id="selected_file"></input>
          <div class="modal-body">
            <div id="adjustment_bodymodal">
              <form>
                <center>
                  <div>
                    <span id="staff_name" style="font-weight: bold;">STAFF NAME</span>
                  </div><br>
                  <div>
                    <span style="text-align: right; font-weight: bold;">SELECT TERMINAL NO:</span>
                    <select onchange="get_nav_terminal_data_js()" id="terminal_no"></select>
                  </div>
                  <table style="font-size: 13px;">
                          <tr>
                              <th colspan="2"><center>ORIGIN</center></th>
                              <th colspan="2"><center>TRANSFER TO</center></th>
                          </tr>
                          <tr>
                              <td style="text-align: right;">SELECT MOP:</td>
                              <td style="padding: 2px;">
                                  <select onchange="get_mop_amount_js()" id="origin_mop"></select>
                              </td>
                              <td style="text-align: right;">SELECT MOP:</td>
                              <td style="padding: 2px;">
                                  <select id="transfer_mop" onchange="validate_mop_transfer_js()"></select>
                              </td>
                          </tr>
                          <tr>
                              <td style="text-align: right;">CURRENT AMOUNT:</td>
                              <td style="padding: 2px;">
                                  <input style="width: 100px; text-align: center;" disabled id="origin_amount"></input>
                              </td>
                              <td style="text-align: right;">AMOUNT TO TRANSFER:</td>
                              <td style="padding: 2px;">
                                  <input class="transfer_amount" onkeyup="maxmin_amount_js()" style="width: 100px; text-align: center;" id="transfer_amount"></input>
                              </td>
                          </tr>
                          <tr>
                              <td style="text-align: right;">REASON:</td>
                              <td style="padding: 2px;">
                                  <textarea id="reason"></textarea>
                              </td>
                              <td style="text-align: right;">ATTACHED FILE:</td>
                              <td style="padding: 2px;">
                                  <input type="file" name="files[]" multiple="multiple" id="attached_file" onchange="GetFileInfo()" style="display: inline;"></input>
                                  <!-- <input type="button" id="add_btn" class="btn-success waves-effect" value="➕" onclick="add_adjustment_js()" style="margin-top: -1%; border: 1px;"> -->
                              </td>
                          </tr>
                  </table>
                </center>
              </form>
            </div><br>

            <label hidden id="total_lbl"></label>
            <div id="adjustment_div">
              
            </div>
          </div>
      
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" onclick="add_adjustment_js()" id="add_btn">Add</button>
            <button type="button" class="btn btn-warning" onclick="sumbmit_adjustment_js_v2()" id="adjust_btn">Adjust</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
<!-- ===============================================end of adjustment modal======================================================= -->

<script src="<?php echo base_url();?>assets/src/jquery.maskMoney.js" type="text/javascript"></script>
<script type="text/javascript">

    $("#terminal_no").click(function(){
      $(".select_mop").prop('disabled', true);  
    });

    $("#transfer_mop").click(function(){
      $(".select_mop").prop('disabled', true);  
    });

    /*======================================auto comma in number=================================================================*/
    $(".transfer_amount").maskMoney({thousands:',', decimal:'.', allowZero: true, suffix: ' '});
    /*=============================================================================================================================*/

</script>

