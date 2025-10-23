

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
    <div class="modal" tabindex="-1" id="partial_remitted_modal">
      <div class="modal-dialog">
        <div class="modal-content" id="partial_remitted_contentmodal" style="width: 130%; margin-left: -100px;">
          <div class="modal-header" id="partial_remitted_headermodal">
            <h5 class="modal-title"><center style="font-weight: bold;">BATCH <span id="batch_header_modal"></span></center></h5>
          </div>
     
          <div class="modal-body">
            <div id="partial_remitted_bodymodal">
                
            </div>
          </div>
      
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="close_partial_remitted_modal_js()">CLOSE ❌</button>
          </div>

        </div>
      </div>
    </div>
<!-- ===============================================end of noncash confirmation modal======================================================= -->

<script type="text/javascript">
	
  function close_partial_remitted_modal_js()
  {
    $('#partial_remitted_modal').modal('toggle');
  }

</script>

