

<style type="text/css">
	
	  .swal2-container
    {
        z-index: 300000!important;
    }

</style>


<!-- =================================================noncash confirmation modal======================================================= -->
    <div class="modal" tabindex="-1" id="remit_to_treasury_modal">
      <div class="modal-dialog">
        <div class="modal-content" id="remit_to_treasury_contentmodal" style="width: 130%; margin-left: -100px;">
          <div class="modal-header" id="remit_to_treasury_headermodal">
            <!-- <h5 class="modal-title"><center style="font-weight: bold;"><span id="remittance_type_modal"></span> REMIT - BATCH <span id="batch_no"></span></center></h5> -->
            <h5 class="modal-title"><center style="font-weight: bold;">BATCH <span id="batch_no"></span></center></h5>
          </div><br>
          <form>
            <center>
              <label><span style="font-size: 12px; font-weight: bold;">BUSINESS UNIT:</span> <span style="font-size: 12px;" id="bname"></span></label>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <label><span style="font-size: 12px; font-weight: bold;">DEPARTMENT:</span> <span style="font-size: 12px;" id="dname"></span></label>
            </center>
          </form>
          <label hidden id="selected_id"></label>
          <label hidden id="dcode"></label>
          <div class="modal-body">
            <div id="remit_to_treasury_bodymodal">
                
            </div>
          </div>
      
          <div class="modal-footer" style="margin-top: -3%;">
            <button type="button" class="btn btn-warning waves-effect" onclick="remit_selected_cash_js()">REMIT ✔️</button>
            <button type="button" class="btn btn-primary waves-effect" onclick="close_remit_to_treasury_modal_js()">CLOSE ❌</button>
          </div>

        </div>
      </div>
    </div>
<!-- ===============================================end of noncash confirmation modal======================================================= -->

<script type="text/javascript">
	
  function close_remit_to_treasury_modal_js()
  {
    $('#remit_to_treasury_modal').modal('toggle');
  }

</script>

