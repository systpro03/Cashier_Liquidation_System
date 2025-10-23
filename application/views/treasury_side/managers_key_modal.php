



<style type="text/css">
	
	  .swal2-container
    {
        z-index: 300000!important;
    }

    #cash_form label {
   float: right;
}

</style>


<!-- =================================================cash confirmation modal======================================================= -->
    <div class="modal" tabindex="-1" id="treasury_mkey_modal">
      <div class="modal-dialog">
        <div class="modal-content" id="mkey_contentmodal">
          <div class="modal-header" id="mkey_headermodal">
            <h5 class="modal-title"><center style="color: red;">Note: Manager's key is your HRMS password</center></h5>
          </div>
     
          <div class="modal-body">
          	<!-- <form style="margin-left: 35%;">
                <label id="cmodalcashremit_type" style="font-weight: bold;"></label>
            </form> -->
            <div id="mkey_bodymodal">
                <div class="table-scrollable">
                	<!-- <div class="row"> -->
    <!-- ================================column 1 ============================================================================== -->
                		<!-- <div class="col-md-6"> -->
		                    <table class="table table-striped table-bordered table-hover display">
		                        <thead>
		                            <tr>
		                                <th>
		                                    <center>Manager's Key
		                                </th>
		                            </tr>
		                        </thead>
		                            <form name="mkey_form" id="mkey_form">
		                                <tbody>
		                                    <tr>
		                                        <td>
		                                            <center><input id="mkey"></input></center>
		                                        </td>
		                                    </tr>
		                                </tbody>
		                            </form>
		                        </table>
	                      <!-- </div> -->
<!-- =============================================================end column 1=============================================================== -->

	                    <!-- </div> -->
                    </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-warning" id="modal_submitbtn" onclick="">Submit</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
            <!-- ===============================================end of cash confirmation modal======================================================= -->

