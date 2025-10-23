



<style type="text/css">
	
	  .swal2-container
    {
        z-index: 300000!important;
    }

</style>


<!-- =================================================adjustment modal======================================================= -->
    <div class="modal" tabindex="-1" id="managers_key_modal" style="padding-right: 0px;">
      <div class="modal-dialog">
        <div class="modal-content" id="managers_key_contentmodal" style="width: 80%;">
          <div class="modal-header" id="managers_key_headermodal">
            <h5 class="modal-title"><center style="font-weight: bold;">MANAGER'S KEY</center></h5>
          </div>
     
          <label hidden id="remitted_info"></label>
          <div class="modal-body">
            <div id="managers_key_bodymodal">
              <form>
                <center>
                  <table style="border-collapse: separate; border-spacing: 5px; font-size: 18px;">
                    <tr>
                      <td style="text-align: right;">Username:</td>
                      <td><input id="username"></input></td>
                    </tr>
                    <tr>
                      <td style="text-align: right;">Password:</td>
                      <td><input type="password" id="password"></input></td>
                    </tr>
                  </table>
                </center>
              </form>
            </div>
          </div>
      
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" onclick="delete_remitted_cash_js()" id="login_btn">LOG-IN</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
          </div>

        </div>
      </div>
    </div>
<!-- ===============================================end of adjustment modal======================================================= -->
<script type="text/javascript">

</script>

