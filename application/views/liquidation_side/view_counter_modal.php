

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
    <div class="modal" tabindex="-1" id="assigned_counter_modal">
      <div class="modal-dialog">
        <div class="modal-content" id="assigned_counter_contentmodal" style="width: 130%; margin-left: -100px;">
          <div class="modal-header" id="assigned_counter_headermodal">
            <h5 class="modal-title"><center style="font-weight: bold;"><span id="header_modal"></span> - Assigned Counter</center></h5>
          </div>
     
          <div class="modal-body">
            <div id="assigned_counter_bodymodal">
                
            </div>
          </div>
      
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="close_assigned_counter_modal_js()">CLOSE ❌</button>
          </div>

        </div>
      </div>
    </div>
<!-- ===============================================end of noncash confirmation modal======================================================= -->

<script type="text/javascript">
	
  function close_assigned_counter_modal_js()
  {
    $('#assigned_counter_modal').modal('toggle');
  }

</script>

