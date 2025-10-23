

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
    <div class="modal" tabindex="-1" id="partialdetails_modal" style="width: 120%; margin-left: 45%;">
      <div class="modal-dialog">
        <div class="modal-content" id="partialdetails_contentmodal">
          <div class="modal-header" id="partialdetails_headermodal">
            <h5 class="modal-title"><center style="font-weight: bold;">Partial Remittance Details</center></h5>
          </div>
     
          <div class="modal-body">
            <div id="partialdetails_bodymodal">
                
            </div>
          </div>
      
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="close_partialdetails_modal_js()">CLOSE ❌</button>
          </div>

        </div>
      </div>
    </div>
<!-- ===============================================end of noncash confirmation modal======================================================= -->

<script type="text/javascript">
	
  function close_partialdetails_modal_js()
  {
    $('#partialdetails_modal').modal('toggle');
  }

</script>

