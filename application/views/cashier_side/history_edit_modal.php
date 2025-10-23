



<style type="text/css">
	
	  .swal2-container
    {
        z-index: 300000!important;
    }

    #cash_form label {
        float: right;
    }

</style>


<!-- =================================================noncash confirmation modal======================================================= -->
    <div class="modal" tabindex="-1" id="history_edit_modal">
      <div class="modal-dialog">
        <div class="modal-content" id="history_edit_contentmodal">
          <div class="modal-header" id="history_edit_headermodal">
            <h5 class="modal-title"><center style="font-weight: bold;">Edit Mode Of Payment</center></h5>
          </div>

          <label hidden id="edit_mop_id"></label>
          <div class="modal-body">
            <div id="history_edit_bodymodal">
              <form>
                <center>
                  <span id="" style="font-size: 17px; font-weight: bold;">Select MOP:</span>
                  <select id="edit_mop_name" style="font-size: 17px; font-weight: bold;"></select><br><br>
                    &nbsp;&nbsp;&nbsp;
                    <span id="" style="font-size: 17px; font-weight: bold;">Quantity:</span>
                    <input id="edit_nc_quantity" min="1" type="number" class="nc_quantity" style="font-size: 17px; font-weight: bold; text-align: center; height: 29px; width: 80px;">
                    &nbsp;&nbsp;&nbsp;
                    <span id="" style="font-size: 17px; font-weight: bold;">Amount:</span>
                    <input id="edit_nc_amount" min="1" type="number" class="edit_nc_amount" style="font-size: 17px; font-weight: bold; text-align: center; height: 29px; width: 80px;">
                </center>
              </form>
            </div>
          </div>
      
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" onclick="update_history_noncash_mop_js()">UPDATE</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
          </div>

        </div>
      </div>
    </div>
<!-- ===============================================end of noncash confirmation modal======================================================= -->

<script src="<?php echo base_url();?>assets/src/jquery.maskMoney.js" type="text/javascript"></script>
<script type="text/javascript">

    // $(".edit_nc_amount").maskMoney({thousands:",", decimal:".", allowZero: true, suffix: " "});

</script>

