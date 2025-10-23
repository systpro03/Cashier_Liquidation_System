<!-- swal alert -->
<!-- <script src="<?php echo base_url('assets/js/dataTables.fixedHeader.min.js'); ?>"></script> -->
<script src="<?php echo base_url('assets/js/sweetalert2@11.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.min.js'); ?>"></script>


<script>
  
function pending_adjustment_js()
{
    $('#pending_adjustment_div').html('');
    $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>get_pending_adjustment_route',
        dataType: 'json',
        success: function(data) {
            if(data == 'EXPIRED SESSION')
            {
                Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
              
                setTimeout(function() {
                  window.parent.location.href = "<?php echo base_url() ?>accounting_supervisor_dashboard_route";
                }, 1000);
            }
            else
            {
                $('#pending_adjustment_div').html(data.html);
                pending_adjustment_datatable();
            }
        }
    });
}

function approved_adjustment_js()
{
    $('#approved_adjustment_div').html('');
    $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>get_approved_adjustment_route',
        dataType: 'json',
        success: function(data) {
            if(data == 'EXPIRED SESSION')
            {
                Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
              
                setTimeout(function() {
                  window.parent.location.href = "<?php echo base_url() ?>accounting_supervisor_dashboard_route";
                }, 1000);
            }
            else
            {
                $('#approved_adjustment_div').html(data.html);
                approved_adjustment_datatable();
            }
        }
    });
}

function approved_adjustment_datatable() 
{
  $(document).ready(function() {
    $('#approved_adjustment_table').DataTable({
      "columnDefs": 
      [
        {"className": "text-center", "targets": [1,2,3,4,5,6,7]}
      ],
      "order": [
        [4, "desc"], [ 0, 'asc' ]
      ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
    });
  });
}

function pending_adjustment_datatable() 
{
  $(document).ready(function() {
    $('#pending_adjustment_table').DataTable({
      "columnDefs": 
      [
        {"className": "text-center", "targets": [1,2,3,4,5,6,7]}
      ],
      "order": [
        [4, "desc"], [ 0, 'asc' ]
      ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
    });
  });
}

function th_checked_js()
{
  if($("#th_checkbox").prop("checked") == true)
  {
      $(".td_checkbox").prop( "checked", true );  
  }
  else
  {
      $(".td_checkbox").prop( "checked", false );
  }
}

function approve_pending_request_js()
{
  var check = $("input[class='td_checkbox']:checked").map(function() {
          return this.value;
        }).get();

        if(check == '')
        {
          Swal.fire('NO SELECTED', 'Please select checkbox before click approve button', 'error');
          return;
        }
        else
        {
          Swal.fire({
            title: 'Are you sure you want to approve request?',
            icon: 'info',
            showDenyButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            customClass: {
            actions: 'my-actions',
            confirmButton: 'order-2',
            denyButton: 'order-3',
            }
            }).then((result) => {
              if (result.isConfirmed) 
              {
                  $.ajax({
                    type:'post',
                    url: '<?php echo base_url(); ?>approve_pending_request_route',
                    data: {'id': check},
                    dataType:'json',
                    success: function(data)
                    {
                      if(data == 'EXPIRED SESSION')
                      {
                        Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                      
                        setTimeout(function() {
                          window.parent.location.href = "<?php echo base_url() ?>accounting_supervisor_dashboard_route";
                          }, 1000);
                      }
                      else
                      {
                        pending_adjustment_js();
                        Swal.fire('APPROVED', '', 'success');
                      }
                    }
                  });
              } else if (result.isDenied) {
                Swal.fire('CANCELLED', '', 'info')
              }
            })
        }
}

function view_attached_file_js(attached_file)
{
  if(attached_file == '')
  {
    Swal.fire('NO ATTACHED FILE', '', 'error')
  }
  else
  {
    // for not disapear modal in clicking outside of the modal jaygwapo
    $('#supervisor_attached_file_modal').modal({
      backdrop: 'static',
      keyboard: false
    });
    $("#supervisor_attached_file_modal").modal('show');
    $("#supervisor_attached_file_body").html('');
    var file = attached_file.split('|');
    for (let i = 0; i < file.length; i++) {
      $("#supervisor_attached_file_body").append('<a onclick="view_file_js('+"'"+file[i]+"'"+')"><img class="img-fluid" src="<?php echo base_url();?>accounting_attached_file/'+file[i]+'" height="220" width="240" style="padding: 5px;" /></a>');
    }
  }
}

function view_file_js(file_name)
{
  $('#supervisor_imagemodal').modal({
			backdrop: 'static',
			keyboard: false
		});
		$('.supervisor_imagepreview').attr('src', '<?php echo base_url();?>accounting_attached_file/'+file_name);
		$('#supervisor_imagemodal').modal('show');   
}


</script>