



<style type="text/css">
	
	  .swal2-container
    {
        z-index: 300000!important;
    }

    #print_form label 
    {
   		float: right;
		}

</style>


<!-- =================================================cash confirmation modal======================================================= -->
    <div class="modal" tabindex="-1" id="print_confirmationmodal">
      <div class="modal-dialog">
        <div class="modal-content" id="print_contentmodal">
          <div class="modal-header" id="print_headermodal">
            <h5 class="modal-title"><center><label id="print_modal_title" style="font-weight: bold;"></label></center></h5>
          </div>
     
          <div class="modal-body">
          	 <form style="margin-left: 35%;">
                <label id="cmodalcashremit_type" style="font-weight: bold;"></label>
            </form>
            <div id="print_bodymodal" style="margin-top: -6%;">
                <div class="table-scrollable" id="print_div_tbl_modal" class="div_tbl_modal">
               
		                   
                    </div>
            </div>
          </div>

          <div class="modal-footer" style="margin-top: -4%;">
            <button type="button" class="btn btn-warning" id="modal_submitbtn" onclick="print_adjusted_modal_js()">🖨️</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">❌</button>
          </div>

        </div>
      </div>
    </div>
<!-- ===============================================end of cash confirmation modal======================================================= -->

