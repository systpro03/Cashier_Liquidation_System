



<style type="text/css">
	
	  .swal2-container
    {
        z-index: 300000!important;
    }

</style>


<!-- =================================================adjustment modal======================================================= -->
    <div class="modal" tabindex="-1" id="zero_rs_adjustment_modal" style="padding-right: 0px;">
      <div class="modal-dialog">
        <div class="modal-content" id="zero_rs_adjustment_contentmodal" style="width: 80%;">
          <div class="modal-header" id="zero_rs_adjustment_headermodal">
            <h5 class="modal-title"><center style="font-weight: bold;">Adjustment Zero Registered Sales</center></h5>
          </div>
     
          <label hidden id="cashier_info"></label>
          <div class="modal-body">
            <div id="zero_rs_adjustment_bodymodal">
              <form>
                <center>
                  <label style="font-weight: bold;" id="cashier_name"></label><br><br>
                  <table style="border-collapse: separate; border-spacing: 5px; font-size: 15px;">
                    <tr>
                      <td style="text-align: right;">Transaction Count:</td>
                      <td><input style="text-align: right;" type="number" id="tr_count"></input></td>
                    </tr>
                    <tr>
                      <td style="text-align: right;">Total Sales:</td>
                      <td><input style="text-align: right;" disabled id="total_sales"></input></td>
                    </tr>
                    <tr>
                      <td style="text-align: right;">Registered Sales:</td>
                      <td><input class="zero_rs" onkeyup="zero_rs_compute_variance_js()" style="text-align: right;" id="registered_sales" placeholder="0.00"></input></td>
                    </tr>
                    <tr>
                      <td style="text-align: right;" id="variance_txt">Variance:</td>
                      <td><input disabled style="text-align: right;" id="zero_rs_variance"></input></td>
                    </tr>
                  </table>
                </center>
              </form>
            </div>
          </div>
      
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" onclick="view_mkey_modal_adjust_zero_rs_js()" id="adjust_btn">ADJUST</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
          </div>

        </div>
      </div>
    </div>
<!-- ===============================================end of adjustment modal======================================================= -->

<script src="<?php echo base_url();?>assets/src/jquery.maskMoney.js" type="text/javascript"></script>
<script type="text/javascript">

  /*======================================auto comma in number=================================================================*/
   $(".zero_rs").maskMoney({thousands:',', decimal:'.', allowZero: true, suffix: ' '});
  /*=============================================================================================================================*/

</script>

