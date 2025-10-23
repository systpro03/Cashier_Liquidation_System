



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
    <div class="modal" tabindex="-1" id="noncash_confirmationmodal">
      <div class="modal-dialog">
        <div class="modal-content" id="noncash_contentmodal">
          <div class="modal-header" id="noncash_headermodal">
            <h5 class="modal-title"><center style="color: red;">Note: Please Check Your Inputed Noncash Denomination</center></h5>
          </div>
     
          <div class="modal-body">
              <form>
                <center>
                  <!-- <label id="ncmodalncashremit_type" style="font-weight: bold;"></label> -->
                  <label id="noncash_borrow_lbl" style="font-weight: bold;"></label><br>
                  <label id="section_lbl" style="font-weight: bold;">SECTION:</label>
                  <label id="section_txt" style="font-weight: bold;">SECTION:</label><br>
                  <!-- <label id="space_lbl" style="font-weight: bold;">&nbsp;&nbsp;/&nbsp;&nbsp;</label> -->
                  <label id="sub_section_lbl" style="font-weight: bold;">SUB SECTION:</label>
                  <label id="sub_section_txt" style="font-weight: bold;">SUB SECTION:</label>
                </center>
              </form>
            <div id="noncash_bodymodal">
                <div class="table-scrollable">
               
		                    <table class="table table-striped table-bordered table-hover display">
		                        <thead>
		                            <tr>
		                                <th width="40%">
		                                    <center>DENOMINATION
		                                </th>
		                                <th width="30%">
		                                    <center>QUANTITY
		                                </th>
		                                <th width="30%">
		                                    <center>AMOUNT
		                                </th>
		                            </tr>
		                        </thead>
		                            <form name="noncash_form_modal" id="noncash_form_modal">
		                                <tbody id="tbody_noncash_confirmationmodal">
		                                    
 										  
		                                </tbody>
		                            </form>
		                    </table>
                    </div>
            </div>
          </div>
      
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" id="noncashmodal_submitbtn" onclick="save_noncash_denomination()">Submit</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
<!-- ===============================================end of noncash confirmation modal======================================================= -->

<script type="text/javascript">
	
</script>

