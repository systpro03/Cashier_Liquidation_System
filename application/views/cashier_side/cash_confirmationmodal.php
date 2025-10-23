



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
    <div class="modal" tabindex="-1" id="cash_confirmationmodal">
      <div class="modal-dialog">
        <div class="modal-content" id="cash_contentmodal">
          <div class="modal-header" id="cash_headermodal">
            <h5 class="modal-title"><center><span style="color: red;">Note!</span> Please Check Your Inputed Cash Denomination</center></h5>
          </div>
     
          <div class="modal-body">
          	 <form>
                <center>
					<label id="cmodalcashremit_type" style="font-weight: bold;"></label>
					<label id="cash_borrow_lbl" style="font-weight: bold;"></label><br class="br">
					<label id="section_lbl" style="font-weight: bold;">SECTION:</label>
					<label id="section_txt" style="font-weight: bold;">SECTION:</label><br class="br">
					<!-- <label id="space_lbl" style="font-weight: bold;">&nbsp;&nbsp;/&nbsp;&nbsp;</label> -->
					<label id="sub_section_lbl" style="font-weight: bold;">SUB SECTION:</label>
					<label id="sub_section_txt" style="font-weight: bold;">SUB SECTION:</label><br class="br2">
					<label id="pos" style="font-weight: bold;">POS:</label>
					<label id="counter" style="font-weight: bold;">COUNTER:</label>
				</center>
            </form>
            <div id="cash_bodymodal">
                <div class="table-scrollable">
                	<!-- <div class="row"> -->
    <!-- ================================column 1 ============================================================================== -->
                		<!-- <div class="col-md-6"> -->
		                    <table class="table table-striped table-bordered table-hover display">
		                        <thead>
		                            <tr>
		                                <th width="30%">
		                                    <center>DENOMINATION
		                                </th>
		                                <th width="30%">
		                                    <center>QUANTITY
		                                </th>
		                                <th width="40%">
		                                    <center>AMOUNT
		                                </th>
		                            </tr>
		                        </thead>
		                            <form name="cash_form" id="cash_form">
		                                <tbody>
		                                    <tr>
		                                        <td>
		                                            <center><label id="d_onekm">₱1,000</label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="quantity" id="q_onekm"></label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="d_amount" id="a_onekm"></label></center>
		                                        </td>
		                                    </tr>

		                                    <tr>
		                                        <td>
		                                            <center><label id="d_fivehm">₱500</label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="quantity1" id="q_fivehm"></label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="d_amount" id="a_fivehm"></label></center>
		                                        </td>
		                                    </tr>

		                                    <tr>
		                                        <td>
		                                            <center><label id="d_twohm">₱200</label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="quantity2" id="q_twohm"></label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="d_amount" id="a_twohm"></label></center>
		                                        </td>
		                                    </tr>

		                                    <tr>
		                                        <td>
		                                            <center><label id="d_onehm">₱100</label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="quantity3" id="q_onehm"></label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="d_amount" id="a_onehm"></label></center>
		                                        </td>
		                                    </tr>

		                                    <tr>
		                                        <td>
		                                            <center><label id="d_fiftym">₱50</label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="quantity4" id="q_fiftym"></label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="d_amount" id="a_fiftym"></label></center>
		                                        </td>
		                                    </tr>

		                                    <tr>
		                                        <td>
		                                            <center><label id="d_twentym">₱20</label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="quantity5" id="q_twentym"></label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="d_amount" id="a_twentym"></label></center>
		                                        </td>
		                                    </tr>

		                                    <tr hidden id="trmodalcash_ten">
		                                        <td>
		                                            <center><label id="d_tenm">₱10</label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="quantity6" id="q_tenm"></label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="d_amount" id="a_tenm"></label></center>
		                                        </td>
		                                    </tr>

		                                    <tr hidden id="trmodalcash_five">
		                                        <td>
		                                            <center><label id="d_fivem">₱5</label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="quantity7" id="q_fivem"></label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="d_amount" id="a_fivem"></label></center>
		                                        </td>
		                                    </tr>

		                                    <tr hidden id="trmodalcash_one">
		                                        <td>
		                                            <center><label id="d_onem">₱1</label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="quantity8" id="q_onem"></label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="d_amount" id="a_onem"></label></center>
		                                        </td>
		                                    </tr>

		                                    <tr hidden id="trmodalcash_twentyfivecents">
		                                        <td>
		                                            <center><label id="d_twentyfivecentsm">₱0.25</label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="quantity9" id="q_twentyfivecentsm"></label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="d_amount" id="a_twentyfivecentsm"></label></center>
		                                        </td>
		                                    </tr>

		                                    <tr hidden id="trmodalcash_tencents">
		                                        <td>
		                                            <center><label id="d_tencentsm">₱0.10</label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="quantity10" id="q_tencentsm"></label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="d_amount" id="a_tencentsm"></label></center>
		                                        </td>
		                                    </tr>

		                                    <tr hidden id="trmodalcash_fivecents">
		                                        <td>
		                                            <center><label id="d_fivecentsm">₱0.05</label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="quantity11" id="q_fivecentsm"></label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="d_amount" id="a_fivecentsm"></label></center>
		                                        </td>
		                                    </tr>

		                                    <tr hidden id="trmodalcash_onecents">
		                                        <td>
		                                            <center><label id="d_onecentsm">₱0.01</label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="quantity12" id="q_onecentsm"></label></center>
		                                        </td>
		                                        <td>
		                                            <center><label class="d_amount" id="a_onecentsm"></label></center>
		                                        </td>
		                                    </tr>

		                                    <tr>
		                                    	<td>
	                                                <label></label>
	                                            </td>
	                                            <td>
	                                                <center><label id="total_cashtxtm" style="font-weight: bold;">TOTAL CASH</label></center>
	                                            </td>
	                                            <td>
	                                                <center><label class="d_amount" id="total_cashm" style="font-weight: bold;"></label></center>
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
            <button type="button" class="btn btn-warning" id="modal_submitbtn" onclick="get_cash_trno_js()">Submit</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
            <!-- ===============================================end of cash confirmation modal======================================================= -->

	<script>
		
	</script>

