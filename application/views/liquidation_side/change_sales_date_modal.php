



<style type="text/css">
	
	  .swal2-container
    {
        z-index: 300000!important;
    }

</style>


<!-- =================================================adjustment modal======================================================= -->
    <div class="modal" tabindex="-1" id="sales_date_adjustment_modal">
      <div class="modal-dialog">
        <div class="modal-content" id="sales_date_adjustment_contentmodal">
          <div class="modal-header" id="sales_date_adjustment_headermodal">
            <h5 class="modal-title"><center style="font-weight: bold;"><span id="name_header"></span> - SALES DATE ADJUSTMENT</center></h5>
          </div>
     
          <label hidden id="cashier_info"></label>
          <div class="modal-body">
            <div id="sales_date_adjustment_bodymodal">
              <form>
                <center>
                  <label style="font-weight: bold;">Deleted Sales Date: <span id="deleted_date" style="color: red;"></span></label>
                </center>
              </form>
            </div>
          </div>
      
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" onclick="change_sales_date_js()" id="adjust_btn">SET AS SALES DATE</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
          </div>

        </div>
      </div>
    </div>
<!-- ===============================================end of adjustment modal======================================================= -->
<script type="text/javascript">

  

</script>

