



<style type="text/css">
	
	  .swal2-container
    {
        z-index: 300000!important;
    }

</style>


<!-- =================================================adjustment modal======================================================= -->
    <div class="modal" tabindex="-1" id="adjustment_modal">
      <div class="modal-dialog">
        <div class="modal-content" id="adjustment_contentmodal">
          <div class="modal-header" id="adjustment_headermodal">
            <h5 class="modal-title"><center style="font-weight: bold;">NAVISION ADJUSTMENT</center></h5>
          </div>
     
          <div class="modal-body">
            <div id="adjustment_bodymodal">
              <form>
                <center>
                  <div>
                    <span id="staff_name" style="font-weight: bold">STAFF NAME</span>
                  </div><br>
                  <table>
                          <tr>
                              <th colspan="2"><center>ORIGIN</center></th>
                              <th colspan="2"><center>TRANSFER TO</center></th>
                          </tr>
                          <tr>
                              <td style="text-align: right;">SELECT MOP:</td>
                              <td style="padding: 2px;">
                                  <select onchange="get_mop_amount_js()" id="orgin_mop"></select>
                              </td>
                              <td style="text-align: right;">SELECT MOP:</td>
                              <td style="padding: 2px;">
                                  <select id="transfer_mop"></select>
                              </td>
                          </tr>
                          <tr>
                              <td style="text-align: right;">CURRENT AMOUNT:</td>
                              <td style="padding: 2px;">
                                  <input style="width: 100px; text-align: center;" disabled id="orgin_amount"></input>
                              </td>
                              <td style="text-align: right;">AMOUNT TO TRANSFER:</td>
                              <td style="padding: 2px;">
                                  <input class="transfer_amount" onkeyup="maxmin_amount_js()" style="width: 100px; text-align: center;" id="transfer_amount"></input>
                              </td>
                          </tr>
                  </table>
                </center>
              </form>
            </div>
          </div>
      
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" onclick="sumbmit_adjustment_js()" id="adjust_btn">Adjust</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
<!-- ===============================================end of adjustment modal======================================================= -->
<script src="<?php echo base_url();?>assets/src/jquery.maskMoney.js" type="text/javascript"></script>
<script type="text/javascript">

    $("#orgin_mop").click(function(){
      $(".select_mop").prop('disabled', true);  
    });

    $("#transfer_mop").click(function(){
      $(".select_mop").prop('disabled', true);  
    });

    /*======================================auto comma in number=================================================================*/
    $(".transfer_amount").maskMoney({thousands:',', decimal:'.', allowZero: true, suffix: ' '});
    /*=============================================================================================================================*/

</script>

