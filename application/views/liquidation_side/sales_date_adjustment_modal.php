



<style type="text/css">
	
	  .swal2-container
    {
        z-index: 300000!important;
    }

</style>


<!-- =================================================adjustment modal======================================================= -->
    <div class="modal" tabindex="-1" id="sales_date_adjustment_modal" style="padding-right: 0px;">
      <div class="modal-dialog">
        <div class="modal-content" id="sales_date_adjustment_contentmodal" style="width: 80%;">
          <div class="modal-header" id="sales_date_adjustment_headermodal">
            <h5 class="modal-title"><center style="font-weight: bold;">SALES DATE ADJUSTMENT</center></h5>
          </div>
     
          <label hidden id="cashier_info"></label>
          <div class="modal-body">
            <div id="sales_date_adjustment_bodymodal">
              <form>
                <center>
                  <label style="font-weight: bold;" id="cashier_name"></label><br><br>
                  <table style="border-collapse: separate; border-spacing: 5px; font-size: 15px;">
                    <tr>
                      <td style="text-align: right;">New Sales Date:</td>
                      <td><input type="date" style="height: 35px;" id="filter_date" disabled></td>
                    </tr>
                  </table>
                </center>
              </form>
            </div>
          </div>
      
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" onclick="view_mkey_modal_sales_date_adjustment_js()" id="update_btn">UPDATE</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
          </div>

        </div>
      </div>
    </div>
<!-- ===============================================end of adjustment modal======================================================= -->

<script src="<?php echo base_url();?>assets/src/jquery.maskMoney.js" type="text/javascript"></script>
<script type="text/javascript">

  // ====================disabled future date +1======================================
    $(function(){
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate() - 1;
        var year = dtToday.getFullYear();

        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;    
        $('#filter_date').attr('max', maxDate);
        $('#filter_date').val(maxDate);
    });
// ===================================================================================
  /*======================================auto comma in number=================================================================*/
  //  $(".zero_rs").maskMoney({thousands:',', decimal:'.', allowZero: true, suffix: ' '});
  /*=============================================================================================================================*/

</script>

