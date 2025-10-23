



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


<!-- =================================================loader modal======================================================= -->
  <div class="modal" tabindex="-1" id="view_variance_loader">
    <div class="modal-dialog">
      <div class="modal-content" id="view_variance_loader_content">
        <!-- <div class="modal-header" id="">
        </div> -->
            <div class="modal-body">
                <form>
                    <center>
                        <div>
                            <img src="<?php echo base_url() ?>loading_gif/gears.gif"><br>
                            <label>Please wait...</label>
                        </div>
                    </center>
                </form>
            </div>
      </div>
    </div>
  </div>
<!-- ===============================================end of loader modal======================================================= -->

<!-- =================================================loader modal======================================================= -->
<div class="modal" tabindex="-1" id="generate_pdf">
    <div class="modal-dialog">
      <div class="modal-content" id="generate_pdf_content">
        <!-- <div class="modal-header" id="">
        </div> -->
            <div class="modal-body">
                <form>
                    <center>
                        <div>
                            <img src="<?php echo base_url() ?>loading_gif/loader.gif"><br>
                            <label>Please wait...</label><br>
                            <label>Generating <span style="color: red;">All</span> PDF in 4 to 5 Minutes...</label>
                        </div>
                    </center>
                </form>
            </div>
            <div class="modal-footer">
              <center>
              <label><span style="color: red;">Note!</span> &nbsp;&nbsp; <label> Do not <span style="color: red;">close or refresh</span> while generating can cause lag to your PC.</label></label>
              </center>
            </div>

            <!-- <div class="modal-footer">
              <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div> -->
      </div>
    </div>
  </div>
<!-- ===============================================end of loader modal======================================================= -->

