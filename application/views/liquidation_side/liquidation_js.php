<!-- swal alert -->
<script src="<?php echo base_url('assets/js/sweetalert2@11.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.min.js'); ?>"></script>


<script>
    
function liqcalculate_breakdown_js() {

  var res = $('#q_onekm').text() * 1000;
  var res1 = $('#q_fivehm').text() * 500;
  var res2 = $('#q_twohm').text() * 200;
  var res3 = $('#q_onehm').text() * 100;
  var res4 = $('#q_fiftym').text() * 50;
  var res5 = $('#q_twentym').text() * 20;
  var res6 = $('#q_tenm').text() * 10;
  var res7 = $('#q_fivem').text() * 5;
  var res8 = $('#q_onem').text() * 1;
  var res9 = $('#q_twentyfivecentsm').text() * 0.25;
  var res10 = $('#q_tencentsm').text() * 0.10;
  var res11 = $('#q_fivecentsm').text() * 0.05;
  var res12 = $('#q_onecentsm').text() * 0.01;
  // console.log(res);
    /* if (res == Number.POSITIVE_INFINITY || res == Number.NEGATIVE_INFINITY || isNaN(res))
    res = "N/A"; // OR 0*/
    var amount = res;
    var amount1 = res1;
    var amount2 = res2;
    var amount3 = res3;
    var amount4 = res4;
    var amount5 = res5;
    var amount6 = res6;
    var amount7 = res7;
    var amount8 = res8;
    var amount9 = res9;
    var amount10 = res10;
    var amount11 = res11;
    var amount12 = res12;

    var amount13 = parseFloat(amount) + 
    parseFloat(amount1) + 
    parseFloat(amount2) + 
    parseFloat(amount3) + 
    parseFloat(amount4) + 
    parseFloat(amount5) + 
    parseFloat(amount6) + 
    parseFloat(amount7) + 
    parseFloat(amount8) + 
    parseFloat(amount9) + 
    parseFloat(amount10) + 
    parseFloat(amount11) + 
    parseFloat(amount12) ;

    $('#a_onekm').text(amount.toLocaleString());
    $('#a_fivehm').text(amount1.toLocaleString());
    $('#a_twohm').text(amount2.toLocaleString());
    $('#a_onehm').text(amount3.toLocaleString());
    $('#a_fiftym').text(amount4.toLocaleString());
    $('#a_twentym').text(amount5.toLocaleString());
    $('#a_tenm').text(amount6.toLocaleString());
    $('#a_fivem').text(amount7.toLocaleString());
    $('#a_onem').text(amount8.toLocaleString());
    $('#a_twentyfivecentsm').text(amount9.toLocaleString());
    $('#a_tencentsm').text(amount10.toLocaleString());
    $('#a_fivecentsm').text(amount11.toLocaleString());
    $('#a_onecentsm').text(amount12.toLocaleString());
    
    //   ====================TOTAL=====================================
    $('#total_cashm').text(amount13.toLocaleString());
    // ================================================================


     //   ====================PENDING MODAL=====================================
     var ress = $('#pc_vmodal').text().split(',').join('');
     var ress1 = $('#fc_vmodal').text().split(',').join('');
     var ress2 = $('#tnc_vmodal').text().split(',').join('');
     var ress3 = $('#rs_variancemodal').val().split(',').join('');
     var wholesale_discount = $('#wholesale_discount_variancemodal').val().split(',').join('');
     
     var amountt = ress;
     var amountt1 = ress1;
     var amountt2 = ress2;
     var amountt3 = ress3;

     var gt_vmodal = parseFloat(amountt) + parseFloat(amountt1) + parseFloat(amountt2);
     $('#gt_vmodal').text(gt_vmodal.toLocaleString());
    
     var sop_vmodal = 0;
     if(wholesale_discount > 0)
     {
       sop_vmodal = parseFloat(gt_vmodal) + parseFloat(wholesale_discount); 
       sop_vmodal = parseFloat(sop_vmodal) - parseFloat(amountt3);
       $('#sop_vmodal').text(sop_vmodal.toLocaleString());
     }
     else
     {
       sop_vmodal = parseFloat(gt_vmodal) - parseFloat(amountt3);
       $('#sop_vmodal').text(sop_vmodal.toLocaleString());
     }
     //  =======================================================================================
     if(sop_vmodal > 0)
     {
       $('#sop_vmodallbl').text('OVER');
     }
     else if(sop_vmodal < 0)
     {
       $('#sop_vmodallbl').text('SHORT');
     }
     else if(sop_vmodal == 0)
     {
      $('#sop_vmodallbl').text('NO VARIANCE');
     }
  }

  function wholesale_dicount_js()
  {
     var grand_total = $('#gt_vmodal').text().split(',').join('');
     var registered_sales = $('#rs_variancemodal').val().split(',').join('');
     var wholesale_discount = $('#wholesale_discount_variancemodal').val().split(',').join('');
     // =========================================================================================== 
     if(registered_sales == '' || registered_sales == 0) 
     {
        var variance = parseFloat(grand_total) + parseFloat(wholesale_discount); 
        $('#sop_vmodal').text(variance.toLocaleString());
        //  =======================================================================================
        if(variance > 0)
        {
          $('#sop_vmodallbl').text('OVER');
        }
        else if(variance < 0)
        {
          $('#sop_vmodallbl').text('SHORT');
        }
        else if(variance == 0)
        {
          $('#sop_vmodallbl').text('NO VARIANCE');
        }
     }
     else
     {
        var total = parseFloat(grand_total) + parseFloat(wholesale_discount);
        var variance = parseFloat(total) - parseFloat(registered_sales);
        $('#sop_vmodal').text(variance.toLocaleString());
        //  =======================================================================================
        if(variance > 0)
        {
          $('#sop_vmodallbl').text('OVER');
        }
        else if(variance < 0)
        {
          $('#sop_vmodallbl').text('SHORT');
        }
        else if(variance == 0)
        {
          $('#sop_vmodallbl').text('NO VARIANCE');
        }
     }
  }

  function view_pendingdenomination_js()
  {
      $('#divbody_pendingdentable').html('');
      $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>view_pendingdenomination_route',
          dataType: 'json',
          success: function(data) {
            $('#divbody_pendingdentable').html(data.html);
            setTimeout(function() {
                pending_datatable();
            }, 1000);
          }
      });
  }

  function view_transferred_den_js()
  {
    $('#divbody_transferred_dentable').html('');
    $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>view_transferred_den_route',
          data: {'date': $("#filter_date").val()},
          dataType: 'json',
          success: function(data) {
            $('#divbody_transferred_dentable').html(data.html);
            transferred_datatable();
          }
    });
  }

  function transferred_datatable() 
  {
    $(document).ready(function() {
      $('#transferred_den_table').DataTable({
        "columnDefs": 
        [
          {"className": "text-center", "targets": [0,1,2,3,4,5,6,7,8,9]}
        ],
        "order": [
          [3, "desc"], [0, "asc"]
        ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
      });
    });
  }

  function view_cashier_partial_remitted_js()
  {
    $('#divbody_partial_remitted_table').html('');
    $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>view_cashier_partial_remitted_route',
          data: {'date': $("#filter_date").val()},
          dataType: 'json',
          success: function(data) {
            $('#divbody_partial_remitted_table').html(data.html);
            cashier_partial_remitted_datatable();
          }
    });
  }

  function cashier_partial_remitted_datatable() 
  {
    $(document).ready(function() {
      $('#cashier_partial_remitted_table').DataTable({
        "columnDefs": 
        [
          {"className": "text-center", "targets": [0,1,2,3,4,5,6]}
        ],
        "order": [
          [3, "desc"], [0, "asc"]
        ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
      });
    });
  }

  function received_cash_js()
  {
    $("#th_checkbox").prop('disabled', false);
    $("#remit_btn").prop('disabled', false);
    $('#divbody_received_cash_table').html('');
    // ===========================================================================
    $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>view_received_cash_route',
        data: {'dcode': $("#dept_name option:selected").val()}, 
        dataType: 'json',
        success: function(data) {
          if(data.message == 'EMPTY')
          {
            $("#remit_btn").prop('disabled', true);
          }
          // =======================================================================
          $('#divbody_received_cash_table').html(data.html);
          received_cash_datatable(data.message);
        }
    });
  }

  function received_cash_datatable(message) 
  {
    $(document).ready(function() {
      $('#received_cash_table').DataTable({
        "columnDefs": 
        [
          {"className": "text-center", "targets": [1,2,3,4,5]}
        ],
        "order": [
          [2, "asc"], [0, "asc"]
        ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
      });
    });
    // ==============================================================
    if(message == 'EMPTY')
    {
      $("#th_checkbox").prop('disabled', true);
    }
  }

  function partial_remitted_cash_js()
  {
    $('#divbody_partial_remitted_cash_table').html('');
    $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>view_partial_remitted_cash_route',
        data: {'date': $("#filter_date").val()},
        dataType: 'json',
        success: function(data) {
          $('#divbody_partial_remitted_cash_table').html(data.html);
          partial_remitted_cash_datatable();
        }
    });
  }

  function partial_remitted_cash_datatable() 
  {
    $(document).ready(function() {
      $('#partial_remitted_cash_table').DataTable({
        "columnDefs": 
        [
          {"className": "text-center", "targets": [0,1,2,3,4,5,6]}
        ],
        "order": [
          [1, "desc"], [2, "asc"]
        ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
      });
    });
  }

  function deleted_remitted_cash_js()
  {
    $('#divbody_deleted_remitted_cash_table').html('');
    $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>view_deleted_remitted_cash_route',
        dataType: 'json',
        success: function(data) {
          $('#divbody_deleted_remitted_cash_table').html(data.html);
          deleted_remitted_cash_datatable();
        }
    });
  }

  function deleted_remitted_cash_datatable() 
  {
    $(document).ready(function() {
      $('#partial_remitted_cash_table').DataTable({
        "columnDefs": 
        [
          {"className": "text-center", "targets": [0,1,2,3,4,5,6]}
        ],
        "order": [
          [1, "desc"], [2, "asc"]
        ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
      });
    });
  }

  function view_pending_noncash_den_js()
  {
    $('#divbody_pending_noncash_dentable').html('');
    $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>view_pending_noncash_den_route',
          dataType: 'json',
          success: function(data) {
            $('#divbody_pending_noncash_dentable').html(data.html);
            pending_noncash_den_datatable();
          }
    });
  }

  function pending_noncash_den_datatable() 
  {
      /*sort datatable*/
      $(document).ready(function() {
        $('#pending_noncash_denomination_table').DataTable({
          "columnDefs": 
          [
            {"className": "text-center", "targets": [0,1,2,3,4]}
          ],
          "order": [
            [4, "desc"]
          ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
        });
      });
  }

  function view_confirmed_denomination_js()
  {
      $('#divbody_confirmed_dentable').html('');
      $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>view_confirmed_denomination_route',
              dataType: 'json',
              success: function(data) {
                $('#divbody_confirmed_dentable').html(data.html);
                confirmed_datatable();
              }
            });
  }

  function confirmed_datatable() 
   {
      /*sort datatable*/
      $(document).ready(function() {
        $('#confirmed_denomination_table').DataTable({
          "columnDefs": 
          [
            {"className": "text-center", "targets": [0,1,2,3,4]}
          ],
          "order": [
            [4, "desc"]
          ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
        });
      });
  }

  function display_cashierlinkaccess_js()
    {
        $('#cashier_access_table').html('');
        $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>display_cashierlinkaccess_route',
                dataType: 'json',
                success: function(data) {
                  // console.log(data);
                 $('#cashier_access_table').html(data.html);
                 cashier_linkaccess_datatable();
                }
              });
    }

  function cashier_linkaccess_datatable()
  {
     /*sort datatable*/
      $(document).ready(function() {
        $('#cashier_access_table').DataTable({
          /*"language": {
            "infoFiltered":"",
            "processing": "<img src='~/Content/images/loadingNew.gif' />"
          },*/ // =======FOR LOADING GIF=======
          "columnDefs": 
          [
            {"className": "text-center", "targets": [0,1,2]}
          ],
          "order": [
            [0, "asc"]
          ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
        });
      });

      document.getElementById("loading").style.visibility = 'hidden';
  }

  function pending_datatable() 
   {
      $(document).ready(function() {
        $('#pending_denomination_table').DataTable({
          "columnDefs": 
          [
            {"className": "text-center", "targets": [0,1,2,3,4,5,6,7]}
          ],
          "order": [
            [7, "asc"], [ 0, 'asc' ]
          ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
        });
      });
  }

  function view_pendingbtn_js(tr_no,emp_id,sscode,pos_name,borrowed,sales_date)
  {
    // for not disapear on clicking outside the modal
    $('#pending_modal').modal({
    backdrop: 'static',
    keyboard: false
    })
    // =================================================================
     var info = tr_no+'|'+emp_id+'|'+sscode+'|'+pos_name+'|'+borrowed+'|'+sales_date;
     $("#pending_modal").modal("show");
     $('#cashier_info').text(info);
     $('#pending_modaltitle').text('');
     $('#borrowed_div').html('');
     $('#liq_cashtbody').html('');
     $('#liq_ncashtbody').html('');
     $('#noncash_borrowed_div').html('');

     $('#cash_confirm_btn').prop('disabled', true);
     $('#print_cashierden_btn').prop('disabled', true);
     $("#thpcm_checkbox").prop('checked', false);
     $("#thpcm_checkbox").prop('disabled', false);
     $("#refresh_cash_btn").prop('disabled', false);
     $("#edit_cashier_den_btn").prop('disabled', false);
     $("#edit_remit_type_btn").prop('disabled', false);
     $('#submit_cashierden_btn').prop('disabled', false);
     $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>get_pendingdenomination_route',
        data: {'tr_no': tr_no,
               'emp_id': emp_id,
               'sscode': sscode,
               'pos_name': pos_name,
               'borrowed': borrowed
        },
        dataType: 'json',
        success: function(data) {
          if(data=='EXPIRED SESSION')
          {
              Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
            
              setTimeout(function() {
                window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
              }, 1000);
          }
          else
          {
            setTimeout(function() {
                check_uncheck_cashcb_js(data.edit_denomination,data.edit_status_denomination,data.edit_remittance_type,data.message);
            }, 100); //e pa una ni ug load para mo gana ang function.
            $('#cash_remit_type').text(data.remit_type);
            $('#pending_modaltitle').text(data.name);
            $('#borrowed_div').html(data.borrowed_html);
            $('#liq_cashtbody').html(data.html); // e pa awahi ang data.html para mo display ang remit type ug name
          }
        }
      }); 
     get_pendingnoncashmodal_js(tr_no,emp_id,sscode,pos_name,borrowed);
     get_variancemodal_js(tr_no,emp_id,sscode,pos_name,borrowed);
  }

  function get_variancemodal_js(tr_no,emp_id,sscode,pos_name,borrowed)
  {
     $('#liq_variancetbody').html('');
     $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>get_variancemodal_route',
          data: {'tr_no': tr_no,
                 'emp_id': emp_id,
                 'sscode': sscode,
                 'pos_name': pos_name,
                 'borrowed': borrowed
          },
          dataType: 'json',
          success: function(data) {
            $('#liq_variancetbody').html(data.html);
          }
      });
  }

  function view_partial_details_js(tr_no,emp_id,sscode,pos_name,borrowed)
  {
    if($("#pc_vmodal").text() <= 0)
    {
      Swal.fire('NO PARTIAL', 'NO RECORD PARTIAL REMIT', 'error');
      return;
    }
    else
    {
       // for not disapear on clicking outside the modal
      $('#partialdetails_modal').modal({
      backdrop: 'static',
      keyboard: false
      })
      // =================================================================
      $('#partialdetails_modal').modal('show');
      $('#partialdetails_bodymodal').html('');
      $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>view_partial_details_route',
          data: {'tr_no': tr_no,
                  'emp_id': emp_id,
                  'sscode': sscode,
                  'pos_name': pos_name,
                  'borrowed': borrowed
          },
          dataType: 'json',
          success: function(data) {
            if(data=='EXPIRED SESSION')
            {
                Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
              
                setTimeout(function() {
                  window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                }, 1000);
            }
            else
            {
              $('#partialdetails_bodymodal').html(data.html);
            }
          }
      });
    }
  }

  function get_pendingnoncashmodal_js(tr_no,emp_id,sscode,pos_name,borrowed)
  {
     $('#liq_ncashtbody').html('');
     $('#noncash_borrowed_div').html('');
     $('#pending_ncashlbl').text('');
     $("#thpncm_checkbox").prop('disabled', false);
     $("#refresh_noncash_btn").prop('disabled', false);
     $("#noncash_confirm_btn").prop('disabled', true);
     $("#add_mop_btn").prop('disabled', false);
     $("#edit_cashier_ncden_btn").prop('disabled', false);
     $("#edit_cashier_ncden_btn").prop('disabled', false);

     $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>get_pendingnoncashmodal_route',
          data: {'tr_no': tr_no,
                 'emp_id': emp_id,
                 'sscode': sscode,
                 'pos_name': pos_name,
                 'borrowed': borrowed
          },
          dataType: 'json',
          success: function(data) {
            if(data.add_mop == 'ENABLED')
            {
              $("#edit_cashier_ncden_btn").prop('disabled', true);
            }
            // =====================================================================================
            if(data.message == 'EMPTY')
            {
              $("#thpncm_checkbox").prop('disabled', true);
              $("#refresh_noncash_btn").prop('disabled', true);
              $("#add_mop_btn").prop('disabled', true);
              $("#edit_cashier_ncden_btn").prop('disabled', true);
            }
            else
            {
              $('#pending_modaltitle').text(data.name);
              $('#pending_ncashlbl').text('FINAL');
              $('#noncash_borrowed_div').html(data.nc_borrowed_html); //NOTE: DAPAT KANI MAUNA KAYSA liq_ncashtbody PARA MO DISPLAY ANG noncash_borrowed_div
              $('#liq_ncashtbody').html(data.html);
            }
          }
      });
  }

  function confirm_pcpmodal_js()
  {
    Swal.fire({
      title: 'Are you sure you want to confirm cash denomination?',
      icon: 'warning',
      showDenyButton: true,
      /* showCancelButton: true,*/
      confirmButtonText: 'Yes',
      denyButtonText: 'No',
      customClass: {
        actions: 'my-actions',
        /*  cancelButton: 'order-1 right-gap',*/
        confirmButton: 'order-2',
        denyButton: 'order-3',
      }
    }).then((result) => {
      if (result.isConfirmed) {
        // ==============================================================================
        var info = $('#cashier_info').text().split('|');
        var remit_type = $("#cash_remit_type").text();
        // ==============================================================================
        $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>confirm_pcpmodal_route', 
          data: {'tr_no': info[0],
                  'emp_id': info[1],
                  'sscode': info[2],
                  'pos_name': info[3],
                  'borrowed': info[4],
                  'remit_type': remit_type
          },
          dataType: 'json',
          success: function(data) {
            if(data == 'EXPIRED SESSION')
            {
                Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                setTimeout(function() {
                  window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                }, 1000);
            }
            else if(data == 'EMPTY')
            {
              view_pendingbtn_js(info[0],info[1],info[2],info[3],info[4],info[5]);
              Swal.fire('ALREADY CONFIRMED', 'This cash remittance is already confirmed by another liquidation officer.', 'error');
            }
            else
            {
              view_pendingbtn_js(info[0],info[1],info[2],info[3],info[4],info[5]);
              Swal.fire('CONFIRMED', '', 'success'); 
              setTimeout(function() {
                view_pendingdenomination_js(); 
                if(remit_type == 'PARTIAL')
                {
                  print_confirm_denominations_js(info[0],info[1],info[2],info[3],info[4]); 
                }
              }, 1000);
            }
          }
        });
      } else if (result.isDenied) {
        Swal.fire('Cancel Confirm', '', 'info')
      }
    })
  }

  function confirm_noncash_js()
  {
    Swal.fire({
      title: 'Are you sure you want to confirm noncash denomination?',
      icon: 'warning',
      showDenyButton: true,
      /* showCancelButton: true,*/
      confirmButtonText: 'Yes',
      denyButtonText: 'No',
      customClass: {
        actions: 'my-actions',
        /*  cancelButton: 'order-1 right-gap',*/
        confirmButton: 'order-2',
        denyButton: 'order-3',
      }
    }).then((result) => {
      if (result.isConfirmed) {
        // ==============================================================================
        var info = $('#cashier_info').text().split('|');
        var remit_type = $("#cash_remit_type").text();
        // ==============================================================================
        $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>confirm_noncash_denomination_route', 
          data: {'tr_no': info[0],
                  'emp_id': info[1],
                  'sscode': info[2],
                  'pos_name': info[3],
                  'borrowed': info[4]
          },
          dataType: 'json',
          success: function(data) {
            if(data == 'EXPIRED SESSION')
            {
                Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                setTimeout(function() {
                  window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                }, 1000);
            }
            else if(data == 'EMPTY')
            {
              refresh_noncashpendingmodal_v2();
              Swal.fire('ALREADY CONFIRMED', 'This noncash remittance is already confirmed by another liquidation officer.', 'error');
            }
            else
            {
              refresh_noncashpendingmodal_v2();
              Swal.fire('CONFIRMED', '', 'success'); 
            }
          }
        });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
  }

  function edit_remittance_type_js()
  {
    Swal.fire({
      title: 'Are you sure you want to enable cashier edit remittance type?',
      icon: 'warning',
      showDenyButton: true,
      /* showCancelButton: true,*/
      confirmButtonText: 'Yes',
      denyButtonText: 'No',
      customClass: {
        actions: 'my-actions',
        /*  cancelButton: 'order-1 right-gap',*/
        confirmButton: 'order-2',
        denyButton: 'order-3',
      }
    }).then((result) => {
      if (result.isConfirmed) {
        // ==============================================================================
        var info = $('#cashier_info').text().split('|');
        // ==============================================================================
        $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>edit_remittance_type_route', 
          data: {'tr_no': info[0],
                  'emp_id': info[1],
                  'sscode': info[2],
                  'pos_name': info[3],
                  'borrowed': info[4]
          },
          dataType: 'json',
          success: function(data) {
            if(data == 'EXPIRED SESSION')
            {
                Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                setTimeout(function() {
                  window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                }, 1000);
            }
            else
            {
              Swal.fire('DONE', 'Cashier can start to edit his/her remittance type.', 'success'); 
              $("#edit_remit_type_btn").prop('disabled', true);
            }
          }
        });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
  }

  function print_confirm_denominations_js(tr_no,emp_id,sscode,pos_name,borrowed)
  {
    window.io = {
      open: function(verb, url, data, target){
          var form = document.createElement("form");
          form.action = url;
          form.method = verb;
          form.target = target || "_self";
          if (data) {
              for (var key in data) {
                  var input = document.createElement("textarea");
                  input.name = key;
                  input.value = typeof data[key] === "object"
                      ? JSON.stringify(data[key])
                      : data[key];
                  form.appendChild(input);
              }

          }
          form.style.display = 'none';
          document.body.appendChild(form);
          form.submit();
          document.body.removeChild(form);
      }
    };
    
    io.open('POST', '<?php echo base_url('print_confirm_denomination_route'); ?>', { tr_no: tr_no, emp_id: emp_id, sscode: sscode, pos_name: pos_name, borrowed: borrowed },'_blank');  
  }

  function print_cashier_partial_denomination_js(id,tr_no,emp_id,sscode,pos_name,borrowed,date)
  {
    window.io = {
      open: function(verb, url, data, target){
          var form = document.createElement("form");
          form.action = url;
          form.method = verb;
          form.target = target || "_self";
          if (data) {
              for (var key in data) {
                  var input = document.createElement("textarea");
                  input.name = key;
                  input.value = typeof data[key] === "object"
                      ? JSON.stringify(data[key])
                      : data[key];
                  form.appendChild(input);
              }

          }
          form.style.display = 'none';
          document.body.appendChild(form);
          form.submit();
          document.body.removeChild(form);
      }
    };
    
    io.open('POST', '<?php echo base_url('print_cashier_partial_denomination_route'); ?>', { id: id, tr_no: tr_no, emp_id: emp_id, sscode: sscode, pos_name: pos_name, borrowed: borrowed, date: date },'_blank');  
  }

  function refresh_pendingmodal()
  {
    view_pendingdenomination_js();
    $('#pending_modaltitle').text('');
    $('#borrowed_div').html('');
    $('#liq_cashtbody').html('');
    $("#thpcm_checkbox").prop('disabled', false);
    $('#thpcm_checkbox').prop('checked', false);
    $("#refresh_cash_btn").prop('disabled', false);
    $('#edit_remit_type_btn').prop('disabled', false);
    $('#edit_cashier_den_btn').prop('disabled', false);
    // ==============================================================================
    var info = $('#cashier_info').text().split('|');
    $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>get_pendingdenomination_route',
        data: {'tr_no': info[0],
               'emp_id': info[1],
               'sscode': info[2],
               'pos_name': info[3],
               'borrowed': info[4]
        },
        dataType: 'json',
        success: function(data) {
          if(data=='EXPIRED SESSION')
          {
              Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
            
              setTimeout(function() {
                window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
              }, 1000);
          }
          else
          {   
              $('#pending_modaltitle').text(data.name);
              $('#borrowed_div').html(data.borrowed_html);
              $('#liq_cashtbody').html(data.html); // e pa awahi ang data.html para mo display ang remit type ug name
              check_uncheck_cashcb_js(data.edit_denomination,data.edit_status_denomination,data.edit_remittance_type,data.message); //e pa awahi ni ug load para mo gana ang function.
          }
        }
    });
  }

  function refresh_pendingmodal_v2()
  {
    var info = $("#cashier_info").text().split('|');
    view_pendingdenomination_js();
    view_pendingbtn_js(info[0],info[1],info[2],info[3],info[4],info[5]);
  }

  function check_uncheck_cashcb_js(edit_den,edit_status,edit_remittance,message)
  {
    if(edit_den != '')
      {
        var check_checkbox = edit_den.split(',');
        for (let i=0; i<check_checkbox.length; i++) {
          if($("#cb_1k").val() == check_checkbox[i])
          {
            $("#cb_1k").prop('checked', true);
          } 
          if($("#cb_5h").val() == check_checkbox[i])
          {
            $("#cb_5h").prop('checked', true);
          } 
          if($("#cb_2h").val() == check_checkbox[i])
          {
            $("#cb_2h").prop('checked', true);
          } 
          if($("#cb_1h").val() == check_checkbox[i])
          {
            $("#cb_1h").prop('checked', true);
          } 
          if($("#cb_fifty").val() == check_checkbox[i])
          {
            $("#cb_fifty").prop('checked', true);
          } 
          if($("#cb_twenty").val() == check_checkbox[i])
          {
            $("#cb_twenty").prop('checked', true);
          } 
          if($("#cb_ten").val() == check_checkbox[i])
          {
            $("#cb_ten").prop('checked', true);
          }
          if($("#cb_five").val() == check_checkbox[i])
          {
            $("#cb_five").prop('checked', true);
          }
          if($("#cb_one").val() == check_checkbox[i])
          {
            $("#cb_one").prop('checked', true);
          }
          if($("#cb_twenty_fc").val() == check_checkbox[i])
          {
            $("#cb_twenty_fc").prop('checked', true);
          }
          if($("#cb_ten_c").val() == check_checkbox[i])
          {
            $("#cb_ten_c").prop('checked', true);
          }
          if($("#cb_five_c").val() == check_checkbox[i])
          {
            $("#cb_five_c").prop('checked', true);
          }
          if($("#cb_one_c").val() == check_checkbox[i])
          {
            $("#cb_one_c").prop('checked', true);
          }
        }
      }
      // ==================================================================================================
      if(edit_status == 'ENABLED')
      {
        $('#edit_cashier_den_btn').prop('disabled', true);
      }
      // ==================================================================================================
      if(edit_remittance == 'ENABLED')
      {
        $('#edit_remit_type_btn').prop('disabled', true);
      }
      // ==================================================================================================
      if(message == 'EMPTY')
      {
        $("#thpcm_checkbox").prop('disabled', true);
        $("#refresh_cash_btn").prop('disabled', true);
        $("#edit_cashier_den_btn").prop('disabled', true);
        $("#edit_remit_type_btn").prop('disabled', true);
      }
  }

  function refresh_getvariancemodal_js()
  {
     var emp_id = $('#empid_cashlbl').text();
     if(emp_id == '')
     {
       emp_id = $('#noncash_empid').text();
     }
     $('#liq_variancetbody').html('');
     $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>get_variancemodal_route',
          data: {'emp_id': emp_id},
          dataType: 'json',
          success: function(data) {
            $('#liq_variancetbody').html(data.html);
            disabled_cashbuttons_pendingmodal_js(data.borrowed,data.edit_borrowed,data.edit_denomination,data.edit_den_status,data.cash_message);
          }
        });
  }

  function refresh_noncashpendingmodal()
  {
    view_pendingdenomination_js();
    $('#thpncm_checkbox').prop('checked', false);
    $('#liq_ncashtbody').html('');
    $('#noncash_borrowed_div').html('');
    var emp_id = $('#noncash_empid').text();
    if(emp_id == '')
    {
      emp_id = $('#empid_cashlbl').text();
    }
    $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>get_pendingnoncashmodal_route',
        data: {'emp_id': emp_id},
        dataType: 'json',
        success: function(data) {
          if(data=='EXPIRED SESSION')
          {
              Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
            
              setTimeout(function() {
                window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
              }, 1000);
          }
          else
          {
              if($('#pending_cashlbl').text() == '' && $('#pending_modaltitle').text() == '')
              {
                  $('#pending_cashlbl').html(data.remit_type);
                  $('#pending_modaltitle').html(data.name);
                  $('#noncash_borrowed_div').html(data.nc_borrowed_html); //NOTE: DAPAT KANI MAUNA KAYSA liq_ncashtbody PARA MO DISPLAY ANG noncash_borrowed_div
                  $('#liq_ncashtbody').html(data.html);
                  refresh_noncash_getvariancemodal_js();
              } 
              else
              {
                  $('#noncash_borrowed_div').html(data.nc_borrowed_html); //NOTE: DAPAT KANI MAUNA KAYSA liq_ncashtbody PARA MO DISPLAY ANG noncash_borrowed_div
                  $('#liq_ncashtbody').html(data.html);
                  refresh_noncash_getvariancemodal_js();
              }
              // ========================================================================================
              if(data.edit_pos == 'ENABLED' || data.edit_pos == 'EMPTY')
              {
                  $("#edit_noncash_pos_btn").prop('disabled', true);
              }
              else
              {
                  $("#edit_noncash_pos_btn").prop('disabled', false);
              }
              // ===========================================================================================
              if(data.add_mop == 'ENABLED' || data.add_mop == 'EMPTY')
              {
                  $("#add_mop_btn").prop('disabled', true);
              }
              else
              {
                  $("#add_mop_btn").prop('disabled', false);
              }
          }
        }
      });
  }

  function refresh_noncashpendingmodal_v2()
  {
    var info = $("#cashier_info").text().split('|');
    view_pendingdenomination_js();
    get_pendingnoncashmodal_js(info[0],info[1],info[2],info[3],info[4]);
    get_variancemodal_js(info[0],info[1],info[2],info[3],info[4]);
  }

  function refresh_noncash_getvariancemodal_js()
  {
     $('#liq_variancetbody').html('');
     $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>get_variancemodal_route',
          data: {'emp_id': $('#noncash_empid').text()},
          dataType: 'json',
          success: function(data) {
            $('#liq_variancetbody').html(data.html);
            disabled_noncashbuttons_pendingmodal_js(data.noncash_borrowed,data.noncash_message,data.noncash_edit_borrowed,data.noncash_edit_denomination,data.noncash_cbcheck);
          }
        });
  }

 function get_deptamount_js()
 {
   // console.log($("#bunit_code").val(),$("#dept_code").val(),$('#filter_date').val());
  $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>get_deptamount_route',
        data:{'bunit_code': $('#bunit_code').val(),
              'dept_code': $('#dept_code').val(),
              'filter_date': $('#filter_date').val()
             },
        dataType: 'json',
        success: function(data) {
          // console.log(data.total);
          $('#dept_amount').val(data.total);
          disabled_adjustment_amountfield_js();
        }
      });
 }

 function get_businessunit_js()
 {
   $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>get_businessunit_route',
        dataType: 'json',
        success: function(data) {
          // console.log(data.bunit);
          $('#tr_no').val('00'+data.trno);
          $('#bunit_list').html(data.bunit_html);
          $('#liq_department').html(data.dept_html);
          get_bunitcode_js();    
        }
      });
 }

 function get_bunitcode_js()
 {
   // console.log($('#bunit_list').val());
  $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>get_bunitcode_route',
        data:{'bunit_list': $('#bunit_list').val()},
        dataType: 'json',
        success: function(data) {
          // console.log(data);
          $('#bunit_code').val(data.bcode);
          get_department_js();
        }
      });
 }

 function get_department_js()
 {
   // console.log($('#bunit_code').val(),$('#liq_department').val());
  $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>get_department_route',
        data:{'bunit_code': $('#bunit_code').val(),
              'liq_department': $('#liq_department').val()
             },
        dataType: 'json',
        success: function(data) {
          // console.log(data);
          $('#dept_code').val(data.dcode);
          if($('#dept_code').val() == '')
          {
            Swal.fire('NO ACCESS', 'You dont have access to this department, please check your business unit and department', 'error')
            $('#dept_amount').val('0.00');
            $('#adjustment_amount').val('');
            $('#gt_adjustment').val('');
            disabled_adjustment_amountfield_js();
            return;
          }
          else
          {
            $('#adjustment_amount').val('');
            $('#gt_adjustment').val('');
            get_deptamount_js();
            disabled_adjustment_amountfield_js();
          }

        }
      });
 }

function disabled_adjustment_amountfield_js()
{
    
    if($("#dept_amount").val() == '' || $("#dept_amount").val() == '0.00')
    {
         document.getElementById("adjustment_amount").disabled = true;
    }
    else
    {
        document.getElementById("adjustment_amount").disabled = false;
    }
}

function calculate_gtadjusment_js()
{ 
    var dept_amount = $("#dept_amount").val();
    var dept_amount2 = dept_amount.split(',').join('');

    var adjustment_amount = $("#adjustment_amount").val();

    if(adjustment_amount == '' || adjustment_amount == '.' || adjustment_amount == '-')
    {
        $('#gt_adjustment').val('');
    }
    else
    {
        var gtotal = parseFloat(dept_amount2) + parseFloat(adjustment_amount);
        $('#gt_adjustment').val(gtotal.toLocaleString());
    }
    // console.log(gtotal);
}

function reset_amount_adjustment_js()
{
    Swal.fire({
    title: 'Are you sure you want to reset?',
    icon: 'warning',
    showDenyButton: true,
    /* showCancelButton: true,*/
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
    actions: 'my-actions',
    /*  cancelButton: 'order-1 right-gap',*/
    confirmButton: 'order-2',
    denyButton: 'order-3',
    }
    }).then((result) => {
      if (result.isConfirmed) 
      {

        window.parent.location.href = "<?php echo base_url() ?>liq_adjustment_route"; 
     
      } else if (result.isDenied) {
        Swal.fire('Cancel reset', '', 'info')
      }
    })
}

function submit_amount_adjustment_js()
{
    Swal.fire({
      title: 'Are you sure you want to submit?',
      icon: 'warning',
      showDenyButton: true,
      /* showCancelButton: true,*/
      confirmButtonText: 'Yes',
      denyButtonText: 'No',
      customClass: {
        actions: 'my-actions',
        /*  cancelButton: 'order-1 right-gap',*/
        confirmButton: 'order-2',
        denyButton: 'order-3',
      }
    }).then((result) => {
      if (result.isConfirmed) {

        var currentdate = new Date();
        var datetime = currentdate.getFullYear() + "-" +
        (currentdate.getMonth() + 1) + "-" +
        currentdate.getDate() + " " +
        currentdate.getHours() + ":" +
        currentdate.getMinutes() + ":" +
        currentdate.getSeconds();

        var amount = $('#dept_amount').val();
        var amount2 = amount.split(',').join('');

        var tot = $('#gt_adjustment').val();
        var tot2 = tot.split(',').join('');
        // console.log(amount2);

         if(tot == '' || tot == '0' || tot == $('#dept_amount').val() || $("#adjustment_reason").val() == '')
         {
            Swal.fire('Missing Data', 'Adjustment Amount, Grand Total and Reason must not be empty or 0!', 'error');
         }
         else
         {
          $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>submit_amount_adjustment_route',
            data: {
              'tr_no': $('#tr_no').val(),
              'filter_date': $('#filter_date').val(),
              'bunit_name': $('#bunit_list').val(),
              'dept_name': $('#liq_department').val(),
              'bunit_code': $('#bunit_code').val(),
              'dept_code': $('#dept_code').val(),
              'dept_amount': amount2,
              'adjustment_amount': $('#adjustment_amount').val(),
              'gt_adjustment': tot2,
              'adjustment_reason': $('#adjustment_reason').val(),
              'date_submit': datetime
            },
            dataType: 'json',
            success: function(data) {
              // console.log(data);

              if(data=='EXPIRED SESSION')
              {
                 Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
               
                 setTimeout(function() {
                   window.parent.location.href = "<?php echo base_url() ?>liq_adjustment_route";
                  }, 1000);
              }
              else
              {
                   Swal.fire('Successfully Save!', '', 'success')    
              
                   setTimeout(function() {
                    window.parent.location.href = "<?php echo base_url() ?>liq_adjustment_route";
                  }, 1000);
              }

            }
          });
        }

      } else if (result.isDenied) {
        Swal.fire('Cancel Submit', '', 'info')
      }
    })
}

function get_adjusted_data_js()
{
    $('#adjustment_viewing_tbody').html('');
    $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>get_adjusted_data_route',
            dataType: 'json',
            success: function(data) {
               // console.log(data.html);
             $('#adjustment_viewing_tbody').html(data.html);
             adjustment_datatable();
            }
          });
}

function display_variance_js()
{
    $('#variance_viewing_tbody').html('');
    $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>display_variance_route',
            dataType: 'json',
            success: function(data) {
               // console.log(data.html);
             $('#variance_viewing_tbody').html(data.html);
             variance_datatable();
            }
          });
}

function variance_datatable() 
{
  /*sort datatable*/
  $(document).ready(function() {
    $('#variance_table').DataTable({
      "columnDefs": 
      [
        {"className": "text-center", "targets": [0,1,2,3,4,5,6,7,8]}
      ],
      "order": [
        [6, "desc"]
      ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
    });
  });
}

function display_adjusted_js()
{
    // console.log($("#dtfrom").val(),$("#dtto").val());
    $('#divbody_adjusted_table').html('');
    $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>display_adjusted_route',
            data: {'dtfrom': $("#dtfrom").val(),
                   'dtto': $("#dtto").val()
                  },
            dataType: 'json',
            success: function(data) {
             // console.log(data.html);
             if(data=='EXPIRED SESSION')
              {
                 Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
               
                 setTimeout(function() {
                   window.parent.location.href = "<?php echo base_url() ?>liq_adjustment_route";
                  }, 1000);
              }
              else
              {
                   $('#divbody_adjusted_table').html(data.html);
                   adjusted_datatable();
              }
            }
          });
}

function adjusted_datatable() 
{
  /*sort datatable*/
  $(document).ready(function() {
    $('#adjusted_table').DataTable({
      retrieve: true,
        dom: 'Bfrtip',
         buttons: [
            // 'copy', 'csv', 'excel', 'pdf', 'print'
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                     {
                        extend: 'copy',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                        }
                      },
                      {
                        extend: 'csv',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                        }
                      },
                      {
                        extend: 'excel',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                        }
                      },
                      /*{
                        extend: 'pdf',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                        }
                      },*/
                      {
                        extend: 'print',
                        title: '<h2 style="font-family: Georgia, serif; font-weight: bold;"><center>CS LIQUIDATION<center></h2>',
                        customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '10pt' );
                           /* .prepend(
                                '<img src="<?php echo base_url(); ?>assets/image/alturas_logo.png" style="position:absolute; top:0; left:0;" />'
                            );*/

                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                        },
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                        }
                      }
                ]
            }
        ],
      "columnDefs": 
      [
        {"className": "text-center", "targets": [0,1,2,3,4,5,6,7,8,9]}
      ],
      "order": [
        [8, "desc"]
      ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
    });
  });
}

function add_cashier_access_js(emp_id,name,emp_no,emp_pins,dcode)
{
  // console.log(emp_id,name);
  Swal.fire({
    title: name,
    text: 'Are you sure you want to add access?',
    icon: 'warning',
    showDenyButton: true,
    /* showCancelButton: true,*/
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
    actions: 'my-actions',
    /*  cancelButton: 'order-1 right-gap',*/
    confirmButton: 'order-2',
    denyButton: 'order-3',
    }
    }).then((result) => {
      if (result.isConfirmed) 
      {

        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>add_cashier_access_route',
            data: {'emp_id': emp_id,
                   'emp_no': emp_no,
                   'emp_pins': emp_pins,
                   'dcode': dcode
                  },
            dataType: 'json',
            success: function(data) {
               // console.log(data.html);
               Swal.fire('Successfully Add!', '', 'success');
                
               /*======================SHOW / HIDE BUTTON============================*/
               document.getElementById('add_'+emp_id).style.visibility = 'hidden';
               document.getElementById('delete_'+emp_id).style.visibility = 'visible';
               document.getElementById('delete_'+emp_id).hidden = false;
               /*====================================================================*/

               /*===========================CENTER BUTTON============================*/
               document.getElementById('delete_'+emp_id).style.transform = 'translateX(-44%)';
               /*====================================================================*/
            }
          });
     
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
}

function delete_cashier_access_js(emp_id,name)
{
  // console.log(emp_id,name);
  Swal.fire({
    title: name,
    text: 'Are you sure you want to delete access?',
    icon: 'warning',
    showDenyButton: true,
    /* showCancelButton: true,*/
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
    actions: 'my-actions',
    /*  cancelButton: 'order-1 right-gap',*/
    confirmButton: 'order-2',
    denyButton: 'order-3',
    }
    }).then((result) => {
      if (result.isConfirmed) 
      {

        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>delete_cashier_access_route',
            data: {'emp_id': emp_id},
            dataType: 'json',
            success: function(data) {
               // console.log(data.html);
               Swal.fire('Successfully Deleted!', '', 'success');

               /*======================SHOW / HIDE BUTTON============================*/
               document.getElementById('add_'+emp_id).hidden = false;
               document.getElementById('add_'+emp_id).style.visibility = 'visible';
               document.getElementById('delete_'+emp_id).style.visibility = 'hidden';
               /*====================================================================*/

               /*===========================CENTER BUTTON============================*/
               document.getElementById('add_'+emp_id).style.transform = 'translateX(61%)';
               /*====================================================================*/
            }
          });
     
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
}

function adjust_variance_js(id,emp_id,emp_name,tms_amount)
{
  // console.log(id,emp_id,tms_amount);
  Swal.fire({
      title: emp_name,
      text: 'Are you sure you want to adjust '+emp_name+' variance?',
      icon: 'warning',
      showDenyButton: true,
      /* showCancelButton: true,*/
      confirmButtonText: 'Yes',
      denyButtonText: 'No',
      customClass: {
        actions: 'my-actions',
        /*  cancelButton: 'order-1 right-gap',*/
        confirmButton: 'order-2',
        denyButton: 'order-3',
      }
    }).then((result) => {
      if (result.isConfirmed) {

         if($('#adjustment_reason'+id).val() == '')
         {
           Swal.fire('Missing Data', 'Please input reason', 'error')
         } 
         else
         {
           // console.log($('#adjustment_reason'+id).val()); 
           $.ajax({
              type:'post',
              url: '<?php echo base_url(); ?>adjust_variance_route',
              data:{'reason': $('#adjustment_reason'+id).val(),
                    'adjusted_amt': tms_amount,
                    'id': id,
                    'emp_id': emp_id
                    },
              dataType:'json',
              success: function(data)
              {
                 // console.log(data);  
                 if(data == 'EXPIRED SESSION')
                  {
                     Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                   
                     setTimeout(function() {
                       window.parent.location.href = "<?php echo base_url() ?>liq_adjustment_route";
                      }, 1000);
                  }
                  else
                  {
                    Swal.fire('Successfully Adjusted!', '', 'success');    
                  
                       setTimeout(function() {
                        window.parent.location.href = "<?php echo base_url() ?>liq_adjustment_route";
                      }, 1000);
                  }
              }
            });
        }

      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
}

function print_adjusted_js(id,emp_id,emp_name)
{
   $.ajax({
              type:'post',
              url: '<?php echo base_url(); ?>print_adjusted_route',
              data:{'id': id,
                    'emp_id': emp_id
                    },
              dataType:'json',
              success: function(data)
              {
                $('#print_confirmationmodal').modal('show');
                $('#print_div_tbl_modal').html(data.html);
                $("#print_modal_title").text(emp_name+' adjusted details');
              }
            });
}

function load_pdf_js()
{
  $.ajax({
              type:'post',
              url: '<?php echo base_url(); ?>load_pdf_route',
              dataType:'json',
              success: function(data)
              {
                
              }
            });
}

function print_adjusted_modal_js()
{
  // console.log($("#printed_id").text(),$("#printed_emp_id").text());
  $.ajax({
            type:'post',
            url: '<?php echo base_url(); ?>update_printing_counter_route',
            data:{'id': $("#printed_id").text(),
                  'emp_id': $("#printed_emp_id").text(),
                  'counter_id': $("#printed_counter_id").text()
                  },
            dataType:'json',
            success: function(data)
            {
              
              if(data == 'EXPIRED SESSION')
              {
                 Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
               
                 setTimeout(function() {
                   window.parent.location.href = "<?php echo base_url() ?>liq_adjustment_route";
                  }, 1000);
              }
              else
              {
                var name = data.toUpperCase();
                // console.log(name);
                var mywindow = window.open('', 'PRINT', 'height=400,width=600');
                // var logo='<img src="<?php echo base_url(); ?>assets/image/alturas_logo.png" alt="" style="width:90px;height:50px;">';

                // mywindow.document.write('<html><head><title>' + document.title  + '</title>');
                mywindow.document.write('<html><head><title>CS LIQUIDATION</title>');
                mywindow.document.write('<style>.th_border{border-top: 1px solid black;border-bottom: 1px solid black;}.td_bottom{border-bottom: 1px solid black;}ul li{ display: inline-block; width: 50%;}');
                mywindow.document.write('</style></head><body >');
                // mywindow.document.write('<h1>' + document.title  + '</h1>');
                // mywindow.document.write('<h3><center>CS LIQUIDATION</center></h3>'+'<div style="float: right; margin-top: -7%;">'+logo+'</div>');
                mywindow.document.write('<h3><center>CS LIQUIDATION</center></h3>');
                mywindow.document.write('<div style="margin-left: 10%;">');
                mywindow.document.write(document.getElementById('print_div_tbl_modal').innerHTML);
                mywindow.document.write('<br><br><div> <form style=""><label>PREPARED BY:</label> <label style="margin-left: 37%;">NOTED BY:</label><br><br><br><label style="border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label style="margin-left: 20%; border-bottom: 1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><ul style="margin-top: 0%;"><li><label style="margin-left: -6%;">'+name+'</label><br><label style="margin-left: -6%;">LIQUIDATION OFFICER</label></li><li><label style="margin-left: 22%;">SUPERVISOR</label></li></ul></form></div>');
                mywindow.document.write('</div>');
                mywindow.document.write('</body></html>'); //<label>JUAN DELA CRUZ</label><label style="margin-left: 40%;">ANNA LOPEZ</label><br><label>LIQUIDATION OFFICER</label><label style="margin-left: 40%;">SUPERVISOR</label>

                mywindow.document.close(); // necessary for IE >= 10
                mywindow.focus(); // necessary for IE >= 10*/

                mywindow.print();
                mywindow.close();

                return true;
              }
            }
          });
}

function display_mop_js()
{
  $(".th_yes_checkbox").prop('disabled', false);
  $(".th_no_checkbox").prop('disabled', false);
  $("#save_btn").prop('disabled', false);
  $.ajax({
          type:'post',
          url: '<?php echo base_url(); ?>liq_display_mop_route',
          data: {'dcode': $("#dept_name").val()},
          dataType:'json',
          success: function(data)
          {
            $("#masterfile_column").html(data.html);
            if(data.validate == 'NO DATA')
            {
                $(".th_yes_checkbox").prop('disabled', true);
                $(".th_no_checkbox").prop('disabled', true);
                $("#save_btn").prop('disabled', true);
            }
          }
        });
}

function mop_datatable() 
{
    $(document).ready(function() {
      $('#masterfile_table').DataTable({
       
      });
    });
}

function cbyes_check_uncheck_js(id)
{
  $('#cb_no'+id).prop('checked', false);
  $('.th_yes_checkbox').prop('checked', false);
  $('.th_no_checkbox').prop('checked', false);
}

function check_th_yes_js()
{
  if ($(".yes:checked").length == $(".yes").length) {
      $(".th_yes_checkbox").prop( "checked", true );
  }
}

function check_th_no_js()
{
  if ($(".no:checked").length == $(".no").length) {
      $(".th_no_checkbox").prop( "checked", true );
  }
}

function cbno_check_uncheck_js(id)
{
  $('#cb_yes'+id).prop('checked', false);
  $('.th_no_checkbox').prop('checked', false);
  $('.th_yes_checkbox').prop('checked', false);
}

function get_bunit_name_js()
{
  $.ajax({
          type:'post',
          url: '<?php echo base_url(); ?>get_bunit_name_route',
          dataType:'json',
          success: function(data)
          {
            $("#bunit_name").html(data.bunit_name);
            get_dept_name_js();
          }
        });
}

function get_dept_name_js()
{
  $.ajax({
          type:'post',
          url: '<?php echo base_url(); ?>get_deptname_route',
          data: {'bcode': $("#bunit_name").val()},
          dataType:'json',
          success: function(data)
          {
            $("#dept_name").html(data.dept_name);
            display_mop_js();
          }
        });
}

function sca_get_bunit_name_js()
{
  $.ajax({
          type:'post',
          url: '<?php echo base_url(); ?>get_bunit_name_route',
          dataType:'json',
          success: function(data)
          {
            $("#bunit_name").html(data.bunit_name);
            sca_get_dept_name_js();
          }
        });
}

function scl_get_bunit_name_js()
{
  $.ajax({
          type:'post',
          url: '<?php echo base_url(); ?>get_bunit_name_route',
          dataType:'json',
          success: function(data)
          {
            $("#bunit_name").html(data.bunit_name);
            scl_get_dept_name_js();
          }
        });
}

function scl_get_dept_name_js()
{
  $.ajax({
          type:'post',
          url: '<?php echo base_url(); ?>get_deptname_route',
          data: {'bcode': $("#bunit_name").val()},
          dataType:'json',
          success: function(data)
          {
            $("#dept_name").html(data.dept_name);
            scl_get_cashier_name_js();
          }
        });
}

function sca_get_dept_name_js()
{
  $.ajax({
          type:'post',
          url: '<?php echo base_url(); ?>get_deptname_route',
          data: {'bcode': $("#bunit_name").val()},
          dataType:'json',
          success: function(data)
          {
            $("#dept_name").html(data.dept_name);
            get_cashier_name_js();
          }
        });
}

function scl_get_cashier_name_js()
{
  $.ajax({
          type:'post',
          url: '<?php echo base_url(); ?>scl_get_cashier_name_route',
          data: {'dcode': $("#dept_name").val()},
          dataType:'json',
          success: function(data)
          {
            $("#div_empname_list").html(data.html);
            scl_get_cashier_personnel_js();
            scl_empname_list_datatable();
          }
        });
}

function scl_get_cashier_personnel_js()
{
  $.ajax({
          type:'post',
          url: '<?php echo base_url(); ?>scl_get_cashier_personnel_route',
          data: {'dcode': $("#dept_name").val()},
          dataType:'json',
          success: function(data)
          {
            $("#div_cashier_personnel_list").html(data.html);
            scl_get_cashier_personnel_datatable();
          }
        });
}

function scl_get_cashier_personnel_datatable() 
{
  $(document).ready(function() {
    $('#dept_cashier_personnel_table').DataTable({
      "columnDefs": 
      [
        {"className": "text-center", "targets": [0,1]}
      ],
      "order": [
        [0, "asc"]
      ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
    });
  });
}

function scl_empname_list_datatable() 
{
  $(document).ready(function() {
    $('#scl_empname_table').DataTable({
      "columnDefs": 
      [
        {"className": "text-center", "targets": [0,1]}
      ],
      "order": [
        [0, "asc"]
      ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
    });
  });
}

function thscl_checked_js()
{
  if($("#thscl_checkbox").prop("checked") == true)
  {
      $(".scl_checkbox").prop( "checked", true );  
  }
  else
  {
      $(".scl_checkbox").prop( "checked", false );
  }
}

function thpcm_checked_js()
{
  if($("#thpcm_checkbox").prop("checked") == true)
  {
      $(".pfcm_checkbox").prop( "checked", true );  
      $('#edit_cashier_den_btn').prop('disabled', true);
      $('#cash_confirm_btn').prop('disabled', false);
  }
  else
  {
      $(".pfcm_checkbox").prop( "checked", false );
      $('#edit_cashier_den_btn').prop('disabled', false);
      $('#cash_confirm_btn').prop('disabled', true);
  }
}

function thpncm_checked_js()
{
  if($("#thpncm_checkbox").prop("checked") == true)
  {
      $(".pncm_checkbox").prop( "checked", true );  
      $('#edit_cashier_ncden_btn').prop('disabled', true);
  }
  else
  {
      $(".pncm_checkbox").prop( "checked", false );
      $('#edit_cashier_ncden_btn').prop('disabled', false);
  }
}

function thrc_checked_js()
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

function thscl2_checked_js()
{
  if($("#thscl2_checkbox").prop("checked") == true)
  {
      $(".scl2_checkbox").prop( "checked", true );  
  }
  else
  {
      $(".scl2_checkbox").prop( "checked", false );
  }
}

function get_cashier_name_js()
{
  $.ajax({
          type:'post',
          url: '<?php echo base_url(); ?>get_cashier_name_route',
          data: {'dcode': $("#dept_name").val()},
          dataType:'json',
          success: function(data)
          {
            $("#div_cashier_list").html(data.html);
            get_dept_mop_js();
            cashier_list_datatable();
          }
        });
}

function get_dept_mop_js()
{
  // console.log($("#dept_name").val());
  $.ajax({
          type:'post',
          url: '<?php echo base_url(); ?>get_dept_mop_route',
          data: {'dcode': $("#dept_name").val()},
          dataType:'json',
          success: function(data)
          {
            $("#div_mop_list").html(data.html);
            mop_list_datatable();
          }
        });
}

function mop_list_datatable() 
{
  $(document).ready(function() {
    $('#dept_mop_table').DataTable({
      "columnDefs": 
      [
        {"className": "text-center", "targets": [0,1,2]}
      ],
      "order": [
        [0, "asc"]
      ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
    });
  });
}

function cashier_list_datatable() 
{
  $(document).ready(function() {
    $('#cashier_name_table').DataTable({
      "columnDefs": 
      [
        {"className": "text-center", "targets": [0,1]}
      ],
      "order": [
        [0, "asc"]
      ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
    });
  });
}

function reset_mop_js()
{
  Swal.fire({
    title: 'Are you sure you want to reset?',
    icon: 'warning',
    showDenyButton: true,
    /* showCancelButton: true,*/
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
    actions: 'my-actions',
    /*  cancelButton: 'order-1 right-gap',*/
    confirmButton: 'order-2',
    denyButton: 'order-3',
    }
    }).then((result) => {
      if (result.isConfirmed) 
      {

        window.parent.location.href = "<?php echo base_url() ?>liq_masterfile_route"; 
     
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
}

function save_mop_access_js()
{
  var check = $("input[class='check_box yes']:checked").map(function() {
      return this.value;
      }).get();

  var check2 = $("input[class='check_box no']:checked").map(function() {
      return this.value;
      }).get();

  if(check == '' && check2 == '')
  {
    Swal.fire('NO SELECTED', 'Please select allow access before save.', 'error')
    return;
  }
  else
  {
    Swal.fire({
      title: 'Are you sure you want to save?',
      icon: 'info',
      showDenyButton: true,
      /* showCancelButton: true,*/
      confirmButtonText: 'Yes',
      denyButtonText: 'No',
      customClass: {
      actions: 'my-actions',
      /*  cancelButton: 'order-1 right-gap',*/
      confirmButton: 'order-2',
      denyButton: 'order-3',
      }
      }).then((result) => {
        if (result.isConfirmed) 
        {
          if(check != '')
          {
            var data = '';
            for (let i = 0; i < check.length; i++) 
            {
                data = check[i].split(',');
                $.ajax({
                    type:'post',
                    url: '<?php echo base_url(); ?>save_mop_access_route',
                    data: {'id': data[0],
                          'access': data[1].trim()
                          },
                    dataType:'json',
                    success: function(data)
                    {
                      if(data == 'EXPIRED SESSION')
                      {
                        Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                      
                        setTimeout(function() {
                          window.parent.location.href = "<?php echo base_url() ?>liq_masterfile_route";
                          }, 1000);
                      }
                      else
                      {
                        display_mop_js();
                      }
                    }
                });
            }
          }
          //  =================================================================================================================
          if(check2 != '')
          {
            var data2 = '';
            for (let a=0; a<check2.length; a++) 
            {
                data2 = check2[a].split(',');
                $.ajax({
                    type:'post',
                    url: '<?php echo base_url(); ?>save_mop_access_route',
                    data: {'id': data2[0],
                          'access': data2[1].trim()
                          },
                    dataType:'json',
                    success: function(data)
                    {
                      if(data == 'EXPIRED SESSION')
                      {
                        Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                      
                        setTimeout(function() {
                          window.parent.location.href = "<?php echo base_url() ?>liq_masterfile_route";
                          }, 1000);
                      }
                      else
                      {
                        display_mop_js();
                      }
                    }
                });
            }
          }
          Swal.fire('SAVED', '', 'success');  
        } else if (result.isDenied) {
          Swal.fire('CANCELLED', '', 'info')
        }
      })
  }
}

function thcs_checked_js()
{
  if($("#thcs_checkbox").prop("checked") == true)
  {
      $(".cs_checkbox").prop( "checked", true );  
  }
  else
  {
      $(".cs_checkbox").prop( "checked", false );
  }
}

function thmop_checked_js()
{
  if($("#thmop_checkbox").prop("checked") == true)
  {
      $(".mop_checkbox").prop( "checked", true );  
  }
  else
  {
      $(".mop_checkbox").prop( "checked", false );
  }
}

function add_login_access_js()
{
  Swal.fire({
    title: 'Are you sure you want to add access?',
    icon: 'info',
    showDenyButton: true,
    /* showCancelButton: true,*/
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
    actions: 'my-actions',
    /*  cancelButton: 'order-1 right-gap',*/
    confirmButton: 'order-2',
    denyButton: 'order-3',
    }
    }).then((result) => {
      if (result.isConfirmed) 
      {
        var check = $("input[class='scl_checkbox']:checked").map(function() {
          return this.value;
        }).get();

        if(check == '')
        {
          Swal.fire('NO SELECTED', 'Please select checkbox before click add button', 'error');
          return;
        }
        else
        {
          var check_arr = '';
          for(let i=0; i<check.length; i++)
          {
            check_arr = check[i].split(',');
          
            $.ajax({
                  type:'post',
                  url: '<?php echo base_url(); ?>add_login_access_route',
                  data: {'emp_id': check_arr[0],
                        'emp_no': check_arr[1],
                        'emp_pins': check_arr[2],
                        'dcode': check_arr[3]
                  },
                  dataType:'json',
                  success: function(data)
                  {
                    if(data == 'EXPIRED SESSION')
                    {
                      Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                    
                      setTimeout(function() {
                        window.parent.location.href = "<?php echo base_url() ?>setup_cashier_login_route";
                        }, 1000);
                    }
                    else
                    {
                      scl_get_cashier_name_js();
                      scl_get_cashier_personnel_js();
                    }
                  }
                });
              
              if (i === check.length - 1){ 
                Swal.fire('ADDED', '', 'success'); 
              }
          }
        }
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
}

function cancel_add_login_access_js()
{
  Swal.fire({
    title: 'Are you sure you want to cancel?',
    icon: 'warning',
    showDenyButton: true,
    /* showCancelButton: true,*/
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
    actions: 'my-actions',
    /*  cancelButton: 'order-1 right-gap',*/
    confirmButton: 'order-2',
    denyButton: 'order-3',
    }
    }).then((result) => {
      if (result.isConfirmed) 
      {

        window.parent.location.href = "<?php echo base_url() ?>setup_cashier_login_route"; 
     
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
}

function delete_access_js()
{
  Swal.fire({
    title: 'Are you sure you want to delete access?',
    icon: 'info',
    showDenyButton: true,
    /* showCancelButton: true,*/
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
    actions: 'my-actions',
    /*  cancelButton: 'order-1 right-gap',*/
    confirmButton: 'order-2',
    denyButton: 'order-3',
    }
    }).then((result) => {
      if (result.isConfirmed) 
      {
        var check = $("input[class='scl2_checkbox']:checked").map(function() {
          return this.value;
        }).get();

        if(check == '')
        {
          Swal.fire('NO SELECTED', 'Please select checkbox before click delete button', 'error');
          return;
        }
        else
        {
          var check_arr = '';
          for(let i=0; i<check.length; i++)
          {
            check_arr = check[i].split(',');
          
            $.ajax({
                  type:'post',
                  url: '<?php echo base_url(); ?>delete_access_route',
                  data: {'id': check_arr[0],
                        'emp_id': check_arr[1]
                  },
                  dataType:'json',
                  success: function(data)
                  {
                    if(data == 'EXPIRED SESSION')
                    {
                      Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                    
                      setTimeout(function() {
                        window.parent.location.href = "<?php echo base_url() ?>setup_cashier_login_route";
                        }, 1000);
                    }
                    else
                    {
                      scl_get_cashier_name_js();
                      scl_get_cashier_personnel_js();
                    }
                  }
                });

              if (i === check.length - 1){ 
                Swal.fire('DELETED', '', 'success'); 
              }
          }
        }
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
}

function cancel_set_cashier_access_js()
{
  Swal.fire({
    title: 'Are you sure you want to cancel?',
    icon: 'warning',
    showDenyButton: true,
    /* showCancelButton: true,*/
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
    actions: 'my-actions',
    /*  cancelButton: 'order-1 right-gap',*/
    confirmButton: 'order-2',
    denyButton: 'order-3',
    }
    }).then((result) => {
      if (result.isConfirmed) 
      {

        window.parent.location.href = "<?php echo base_url() ?>setup_cashier_access_route"; 
     
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
}

function set_cashier_access_js()
{
  Swal.fire({
    title: 'Are you sure you want to set as default?',
    icon: 'info',
    showDenyButton: true,
    /* showCancelButton: true,*/
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
    actions: 'my-actions',
    /*  cancelButton: 'order-1 right-gap',*/
    confirmButton: 'order-2',
    denyButton: 'order-3',
    }
    }).then((result) => {
      if (result.isConfirmed) 
      {
        var cn_check = $("input[class='cs_checkbox']:checked").map(function() {
          return this.value;
        }).get();

        var mop_check = $("input[class='mop_checkbox']:checked").map(function() {
          return this.value;
        }).get();
        // console.log(cn_check,mop_check);
        if(cn_check == '')
        {
          Swal.fire('MISSING CASHIER', 'Please select cashier name checkbox before click set as default button', 'error');
          return;
        }
        else if(mop_check == '')
        {
          Swal.fire('MISSING MOP', 'Please select mode of payment checkbox before click set as default button', 'error');
          return;
        }
        else
        {
          var cn_arr = '';
          for(let i=0; i<cn_check.length; i++)
          {
            cn_arr = cn_check[i].split(',');
            
            $.ajax({
                type:'post',
                url: '<?php echo base_url(); ?>set_cashier_access_route',
                data: {'emp_id': cn_arr[0],
                      'dcode': cn_arr[1],
                      'mop_arr': mop_check
                },
                dataType:'json',
                success: function(data)
                {
                  if(data == 'EXPIRED SESSION')
                  {
                    Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                  
                    setTimeout(function() {
                      window.parent.location.href = "<?php echo base_url() ?>setup_cashier_access_route";
                      }, 1000);
                  }
                  else
                  {
                    get_cashier_name_js();
                    get_dept_mop_js();
                  }
                }
              });

              if (i === cn_check.length - 1){ 
                display_cashier_default_assignment_js();
                Swal.fire('DONE', '', 'success'); 
              }
          }
        }
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
}

function validate_access_js()
{
  document.getElementById('set_as_default_btn').disabled = false;

  var cn_check = $("input[class='cs_checkbox']:checked").map(function() {
    return this.value;
  }).get();

  var mop_check = $("input[class='mop_checkbox']:checked").map(function() {
    return this.value;
  }).get();

  var cn_arr = '';
  for(let i=0; i<cn_check.length; i++)
  {
    cn_arr = cn_check[i].split(',');
    
    $.ajax({
        type:'post',
        url: '<?php echo base_url(); ?>validate_access_route',
        data: {'emp_id': cn_arr[0],
               'dcode': cn_arr[1],
               'mop_arr': mop_check
        },
        dataType:'json',
        success: function(data)
        {
          if(data == 'EXPIRED SESSION')
          {
            Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
          
            setTimeout(function() {
              window.parent.location.href = "<?php echo base_url() ?>setup_cashier_access_route";
              }, 1000);
          }
          else if(data.message == 'DUPLICATE ACCESS')
          {
            Swal.fire('DUPLICATE ACCESS', 'NAME: '+data.name+'<br>MODE OF PAYMENT: '+data.mop+'<br>TYPE: '+data.type, 'error');
            document.getElementById('set_as_default_btn').disabled = true;
            return;
          }
        }
      });
  }
}

function display_cashier_default_assignment_js()
{
  $.ajax({
          type:'post',
          url: '<?php echo base_url(); ?>display_cashier_default_assignment_route',
          data: {'dcode': $("#cda_dept_name").val()},
          dataType:'json',
          success: function(data)
          {
            $("#divbody_cashier_default_access_table").html(data.html);
            cashier_default_assignment_datatable();
          }
        });
}

function cashier_default_assignment_datatable() 
{
  $(document).ready(function() {
    $('#cashier_default_access_table').DataTable({
      "columnDefs": 
      [
        {"className": "text-center", "targets": [0,1,2]}
      ],
      "order": [
        [0, "asc"]
      ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
    });
  });
}

function cda_get_bunit_name_js()
{
  $.ajax({
          type:'post',
          url: '<?php echo base_url(); ?>get_bunit_name_route',
          dataType:'json',
          success: function(data)
          {
            $("#cda_bunit_name").html(data.bunit_name);
            cda_get_dept_name_js();
          }
        });
}

function cda_get_dept_name_js()
{
  $.ajax({
          type:'post',
          url: '<?php echo base_url(); ?>get_deptname_route',
          data: {'bcode': $("#cda_bunit_name").val()},
          dataType:'json',
          success: function(data)
          {
            $("#cda_dept_name").html(data.dept_name);
            display_cashier_default_assignment_js();
          }
        });
}

function view_cda_modal_js(emp_id)
{
  $('#cashier_default_access_modal').modal('show');
 
  $.ajax({
          type:'post',
          url: '<?php echo base_url(); ?>display_cda_route',
          data: {'emp_id': emp_id},
          dataType:'json',
          success: function(data)
          {
            $("#cda_name_modal").html(data.cda_name);
            $("#cda_modal_body").html(data.html);
            cda_modal_datatable();
          }
        });
}

function cda_modal_datatable() 
{
  $(document).ready(function() {
    $('#cda_modal_table').DataTable({
      "columnDefs": 
      [
        {"className": "text-center", "targets": [0,1,2]}
      ],
      "order": [
        [0, "asc"]
      ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
    });
  });
}

function th_cdamodal_checked_js()
{
  if($("#th_cdamodal_checkbox").prop("checked") == true)
  {
      $(".cdamodal_checkbox").prop( "checked", true );  
  }
  else
  {
      $(".cdamodal_checkbox").prop( "checked", false );
  }
}

function delete_cda_modal_js()
{
    Swal.fire({
    title: 'Are you sure you want to delete?',
    icon: 'info',
    showDenyButton: true,
    /* showCancelButton: true,*/
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
    actions: 'my-actions',
    /*  cancelButton: 'order-1 right-gap',*/
    confirmButton: 'order-2',
    denyButton: 'order-3',
    }
    }).then((result) => {
      if (result.isConfirmed) 
      {  
        var check = $("input[class='cdamodal_checkbox']:checked").map(function() {
                  return this.value;
                  }).get();
      
        if(check == '')
        {
          Swal.fire('MISSING DATA', 'Please select checkbox before click delete button', 'error');
          return; 
        }
        else
        {
          var cda_arr = '';
          for(let i=0; i<check.length; i++)
          {
            cda_arr = check[i].split(',');
            $.ajax({
                  type:'post',
                  url: '<?php echo base_url(); ?>delete_cda_modal_route',
                  data: {'emp_id': cda_arr[0],
                          'dcode': cda_arr[1],
                          'mop': cda_arr[2],
                          'type': cda_arr[3]
                  },
                  dataType:'json',
                  success: function(data)
                  {
                    if(data == 'EXPIRED SESSION')
                    {
                      Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                    
                      setTimeout(function() {
                        window.parent.location.href = "<?php echo base_url() ?>setup_cashier_access_route";
                        }, 1000);
                    }
                    else
                    {
                      refresh_cda_modal_js(cda_arr[0]);
                      display_cashier_default_assignment_js();
                    }
                  }
                });
            
            if (i === check.length - 1){ 
              Swal.fire('DELETED', '', 'success'); 
            }
          } 
        }
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
}

function refresh_cda_modal_js(emp_id)
{
  $.ajax({
          type:'post',
          url: '<?php echo base_url(); ?>display_cda_route',
          data: {'emp_id': emp_id},
          dataType:'json',
          success: function(data)
          {
            $("#cda_name_modal").html(data.cda_name);
            $("#cda_modal_body").html(data.html);
            cda_modal_datatable();
          }
        });
}

function cancel_borrowed_cashpending_modal_js()
{
  // console.log($("#empid_cashlbl").text());
  Swal.fire({
    title: 'Are you sure you want to cancel borrowed?',
    icon: 'info',
    showDenyButton: true,
    /* showCancelButton: true,*/
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
    actions: 'my-actions',
    /*  cancelButton: 'order-1 right-gap',*/
    confirmButton: 'order-2',
    denyButton: 'order-3',
    }
    }).then((result) => {
      if (result.isConfirmed) 
      {  
        $.ajax({
                type:'post',
                url: '<?php echo base_url(); ?>cancel_borrowed_cashpending_modal_route',
                data: {'cashier_id': $("#empid_cashlbl").text()},
                dataType:'json',
                success: function(data)
                {
                  if(data == 'EXPIRED SESSION')
                  {
                    Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                  
                    setTimeout(function() {
                      window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                      }, 1000);
                  }
                  else
                  {
                    refresh_pendingmodal();
                    Swal.fire('DONE', '', 'success');
                    setTimeout(function() {
                      refresh_noncashpendingmodal();
                    }, 1000);
                  }
                }
              });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
}

function cancel_borrowed_noncashpending_modal_js()
{
  // console.log($("#noncash_empid").text());
  Swal.fire({
    title: 'Are you sure you want to cancel borrowed?',
    icon: 'info',
    showDenyButton: true,
    /* showCancelButton: true,*/
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
    actions: 'my-actions',
    /*  cancelButton: 'order-1 right-gap',*/
    confirmButton: 'order-2',
    denyButton: 'order-3',
    }
    }).then((result) => {
      if (result.isConfirmed) 
      {  
        $.ajax({
                type:'post',
                url: '<?php echo base_url(); ?>cancel_borrowed_noncashpending_modal_route',
                data: {'cashier_id': $("#noncash_empid").text()},
                dataType:'json',
                success: function(data)
                {
                  if(data == 'EXPIRED SESSION')
                  {
                    Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                  
                    setTimeout(function() {
                      window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                      }, 1000);
                  }
                  else
                  {
                    refresh_noncashpendingmodal();
                    Swal.fire('DONE', '', 'success');
                    setTimeout(function() {
                      refresh_pendingmodal();
                    }, 1000);
                  }
                }
              });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
}

function enable_cashier_edit_borrowed_js()
{
    Swal.fire({
    title: 'Are you sure you want to enable cashier edit to borrowed?',
    icon: 'info',
    showDenyButton: true,
    /* showCancelButton: true,*/
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
    actions: 'my-actions',
    /*  cancelButton: 'order-1 right-gap',*/
    confirmButton: 'order-2',
    denyButton: 'order-3',
    }
    }).then((result) => {
      if (result.isConfirmed) 
      {  
        $.ajax({
                type:'post',
                url: '<?php echo base_url(); ?>enable_cashier_edit_borrowed_route',
                data: {'cashier_id': $("#empid_cashlbl").text()},
                dataType:'json',
                success: function(data)
                {
                  if(data == 'EXPIRED SESSION')
                  {
                    Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                  
                    setTimeout(function() {
                      window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                      }, 1000);
                  }
                  else
                  {
                    Swal.fire('DONE', 'Cashier can start to edit borrowed.', 'success');
                    $('#edit_borrowed_btn').prop('disabled', true);
                  }
                }
              });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
}

function enable_cashier_edit_noncashborrowed_js()
{
    Swal.fire({
    title: 'Are you sure you want to enable cashier edit to borrowed?',
    icon: 'info',
    showDenyButton: true,
    /* showCancelButton: true,*/
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
    actions: 'my-actions',
    /*  cancelButton: 'order-1 right-gap',*/
    confirmButton: 'order-2',
    denyButton: 'order-3',
    }
    }).then((result) => {
      if (result.isConfirmed) 
      {  
        $.ajax({
                type:'post',
                url: '<?php echo base_url(); ?>enable_cashier_edit_noncashborrowed_route',
                data: {'cashier_id': $("#noncash_empid").text()},
                dataType:'json',
                success: function(data)
                {
                  if(data == 'EXPIRED SESSION')
                  {
                    Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                  
                    setTimeout(function() {
                      window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                      }, 1000);
                  }
                  else
                  {
                    Swal.fire('DONE', 'Cashier can start to edit borrowed.', 'success');
                    $('#edit_borrowed_ncbtn').prop('disabled', true);
                  }
                }
              });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
}

function enable_cashier_edit_noncashden_js()
{
    Swal.fire({
    title: 'Are you sure you want to enable cashier edit to noncash denomination?',
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
        // ==============================================================================
        var info = $('#cashier_info').text().split('|');
        // ==============================================================================  
        var uncheck = $("input[class='pncm_checkbox']:not(:checked)").map(function() {
          return this.value;
        }).get();
        // ==============================================================================  
        var unchecked = '';
        for (let i=0; i<uncheck.length; i++) {
            unchecked = uncheck[i].split(','); 
            $.ajax({
                type:'post',
                url: '<?php echo base_url(); ?>enable_cashier_edit_noncashden_route', 
                data: {'id': unchecked[0],
                       'tr_no': info[0],
                       'emp_id': info[1],
                       'sscode': info[2],
                       'pos_name': info[3],
                       'borrowed': info[4]
                },
                dataType:'json',
                success: function(data)
                {
                  if(data == 'EXPIRED SESSION')
                  {
                    Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                  
                    setTimeout(function() {
                      window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                      }, 1000);
                  }
                }
            });
        }
// =================================================================================================================================================================
        var check = $("input[class='pncm_checkbox']:checked").map(function() {
                return this.value;
                }).get();
        
        var checked = '';
        for (let i=0; i<check.length; i++) {
            checked = check[i].split(','); 
             $.ajax({
                type:'post',
                url: '<?php echo base_url(); ?>enable_cashier_edit_noncashden_checked_route',
                data: {'id': checked[0],
                       'tr_no': info[0],
                       'emp_id': info[1],
                       'sscode': info[2],
                       'pos_name': info[3],
                       'borrowed': info[4]
                },
                dataType:'json',
                success: function(data)
                {
                  if(data == 'EXPIRED SESSION')
                  {
                    Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                  
                    setTimeout(function() {
                      window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                      }, 1000);
                  }
                }
             });
        }
        Swal.fire('DONE', 'Cashier can start to edit noncash denomination.', 'success');
        $('#edit_cashier_ncden_btn').prop('disabled', true);
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
}

function disabled_cashbuttons_pendingmodal_js(borrowed,edit_borrowed,edit_den,edit_den_status,cash_message)
{

  $("#thpcm_checkbox").prop('checked', false);
  $('#cash_confirm_btn').prop('disabled', true);

  if(borrowed == 'YES')
  {
    $('#cancel_borrowed_btn').prop('disabled', false);
  }
  else
  {
    $('#cancel_borrowed_btn').prop('disabled', true);
  }
  
  if(edit_borrowed == 'ENABLED')
  {
    $('#edit_borrowed_btn').prop('disabled', true);
  }
  else
  {
    $('#edit_borrowed_btn').prop('disabled', false);
  }

  if(edit_den != '')
  {
    var check_checkbox = edit_den.split(',');

    for (let i=0; i<check_checkbox.length; i++) {
      if($("#cb_1k").val() == check_checkbox[i])
      {
        $("#cb_1k").prop('checked', true);
      } 
      if($("#cb_5h").val() == check_checkbox[i])
      {
        $("#cb_5h").prop('checked', true);
      } 
      if($("#cb_2h").val() == check_checkbox[i])
      {
        $("#cb_2h").prop('checked', true);
      } 
      if($("#cb_1h").val() == check_checkbox[i])
      {
        $("#cb_1h").prop('checked', true);
      } 
      if($("#cb_fifty").val() == check_checkbox[i])
      {
        $("#cb_fifty").prop('checked', true);
      } 
      if($("#cb_twenty").val() == check_checkbox[i])
      {
        $("#cb_twenty").prop('checked', true);
      } 
      if($("#cb_ten").val() == check_checkbox[i])
      {
        $("#cb_ten").prop('checked', true);
      }
      if($("#cb_five").val() == check_checkbox[i])
      {
        $("#cb_five").prop('checked', true);
      }
      if($("#cb_one").val() == check_checkbox[i])
      {
        $("#cb_one").prop('checked', true);
      }
      if($("#cb_twenty_fc").val() == check_checkbox[i])
      {
        $("#cb_twenty_fc").prop('checked', true);
      }
      if($("#cb_ten_c").val() == check_checkbox[i])
      {
        $("#cb_ten_c").prop('checked', true);
      }
      if($("#cb_five_c").val() == check_checkbox[i])
      {
        $("#cb_five_c").prop('checked', true);
      }
      if($("#cb_one_c").val() == check_checkbox[i])
      {
        $("#cb_one_c").prop('checked', true);
      }
    }
  }
  
  if(edit_den_status == 'DISABLED' || edit_den_status == '')
  {
    $('#edit_cashier_den_btn').prop('disabled', false);
  }
  else
  {
    $('#edit_cashier_den_btn').prop('disabled', true);
  }

  if(cash_message == 'NO DATA')
  {
    $('#thpcm_checkbox').prop('disabled', true);
    $('#edit_borrowed_btn').prop('disabled', true);
    $('#edit_cashier_den_btn').prop('disabled', true);
    $('#refresh_cash_btn').prop('disabled', true);
  }
  else
  {
    $('#thpcm_checkbox').prop('disabled', false);
    $('#refresh_cash_btn').prop('disabled', false);
  }
}

function enable_cashier_edit_den_js()
{
  if($("#pending_cashlbl").text() == 'CASH FORM  -  PARTIAL  REMITTANCE')
  {
      Swal.fire({
      title: 'Are you sure you want to enable cashier edit to denomination?',
      icon: 'info',
      showDenyButton: true,
      /* showCancelButton: true,*/
      confirmButtonText: 'Yes',
      denyButtonText: 'No',
      customClass: {
      actions: 'my-actions',
      /*  cancelButton: 'order-1 right-gap',*/
      confirmButton: 'order-2',
      denyButton: 'order-3',
      }
      }).then((result) => {
          if (result.isConfirmed) 
          { 
              var check = $("input[class='ppcm_checkbox pfcm_checkbox']:checked").map(function() {
                      return this.value;
                      }).get();

              var edit_data = check.join(',');
              $.ajax({
                      type:'post',
                      url: '<?php echo base_url(); ?>enable_cashier_edit_den_route',
                      data: {'cashier_id': $("#empid_cashlbl").text(),
                            'edit_data': edit_data
                      },
                      dataType:'json',
                      success: function(data)
                      {
                        if(data == 'EXPIRED SESSION')
                        {
                          Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                        
                          setTimeout(function() {
                            window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                            }, 1000);
                        }
                        else
                        {
                            Swal.fire('DONE', 'Cashier can start to edit selected denomination', 'success');
                            $('#edit_cashier_den_btn').prop('disabled', true);
                        }
                      }
                    });
            } else if (result.isDenied) {
              Swal.fire('CANCELLED', '', 'info')
            }
          })
  }
  else
  {
      Swal.fire({
      title: 'Are you sure you want to enable cashier edit to denomination?',
      icon: 'info',
      showDenyButton: true,
      /* showCancelButton: true,*/
      confirmButtonText: 'Yes',
      denyButtonText: 'No',
      customClass: {
      actions: 'my-actions',
      /*  cancelButton: 'order-1 right-gap',*/
      confirmButton: 'order-2',
      denyButton: 'order-3',
      }
      }).then((result) => {
        if (result.isConfirmed) 
        { 
          var check = $("input[name='cashden_checkbox']:checked").map(function() {
                      return this.value;
                      }).get(); 

          var edit_data = check.join(',');
          $.ajax({
                  type:'post',
                  url: '<?php echo base_url(); ?>enable_cashier_edit_den_route',
                  data: {'cashier_id': $("#empid_cashlbl").text(),
                        'edit_data': edit_data
                  },
                  dataType:'json',
                  success: function(data)
                  {
                    if(data == 'EXPIRED SESSION')
                    {
                      Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                    
                      setTimeout(function() {
                        window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                        }, 1000);
                    }
                    else
                    {
                      Swal.fire('DONE', 'Cashier can start to edit selected denomination', 'success');
                      $('#edit_cashier_den_btn').prop('disabled', true);
                    }
                  }
                });
        } else if (result.isDenied) {
          Swal.fire('CANCELLED', '', 'info')
        }
    })
  } 
}

function enable_cashier_edit_den_js_v2()
{
  if($("#cash_remit_type").text() == 'PARTIAL')
  {
      Swal.fire({
      title: 'Are you sure you want to enable cashier edit to denomination?',
      icon: 'info',
      showDenyButton: true,
      /* showCancelButton: true,*/
      confirmButtonText: 'Yes',
      denyButtonText: 'No',
      customClass: {
      actions: 'my-actions',
      /*  cancelButton: 'order-1 right-gap',*/
      confirmButton: 'order-2',
      denyButton: 'order-3',
      }
      }).then((result) => {
          if (result.isConfirmed) 
          { 
              var check = $("input[class='ppcm_checkbox pfcm_checkbox']:checked").map(function() {
                      return this.value;
                      }).get();
              var edit_data = check.join(',');
              // =================================================================================================================
              var info = $("#cashier_info").text().split('|');
              // =================================================================================================================
              $.ajax({
                      type:'post',
                      url: '<?php echo base_url(); ?>enable_cashier_edit_den_route',
                      data: {'tr_no': info[0],
                             'emp_id': info[1],
                             'sscode': info[2],
                             'pos_name': info[3],
                             'borrowed': info[4],
                             'edit_data': edit_data
                      },
                      dataType:'json',
                      success: function(data)
                      {
                        if(data == 'EXPIRED SESSION')
                        {
                          Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                        
                          setTimeout(function() {
                            window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                            }, 1000);
                        }
                        else
                        {
                            Swal.fire('DONE', 'Cashier can start to edit selected denomination', 'success');
                            $('#edit_cashier_den_btn').prop('disabled', true);
                        }
                      }
                    });
            } else if (result.isDenied) {
              Swal.fire('CANCELLED', '', 'info')
            }
          })
  }
  else
  {
      Swal.fire({
      title: 'Are you sure you want to enable cashier edit to denomination?',
      icon: 'info',
      showDenyButton: true,
      /* showCancelButton: true,*/
      confirmButtonText: 'Yes',
      denyButtonText: 'No',
      customClass: {
      actions: 'my-actions',
      /*  cancelButton: 'order-1 right-gap',*/
      confirmButton: 'order-2',
      denyButton: 'order-3',
      }
      }).then((result) => {
        if (result.isConfirmed) 
        { 
          var check = $("input[name='cashden_checkbox']:checked").map(function() {
                      return this.value;
                      }).get(); 
          var edit_data = check.join(',');
          // =================================================================================================================
          var info = $("#cashier_info").text().split('|');
          // =================================================================================================================
          $.ajax({
              type:'post',
              url: '<?php echo base_url(); ?>enable_cashier_edit_den_route',
              data: {'tr_no': info[0],
                      'emp_id': info[1],
                      'sscode': info[2],
                      'pos_name': info[3],
                      'borrowed': info[4],
                      'edit_data': edit_data
              },
              dataType:'json',
              success: function(data)
              {
                if(data == 'EXPIRED SESSION')
                {
                  Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                
                  setTimeout(function() {
                    window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                    }, 1000);
                }
                else
                {
                  Swal.fire('DONE', 'Cashier can start to edit selected denomination', 'success');
                  $('#edit_cashier_den_btn').prop('disabled', true);
                }
              }
          });
        } else if (result.isDenied) {
          Swal.fire('CANCELLED', '', 'info')
        }
    })
  } 
}

function disabled_noncashbuttons_pendingmodal_js(borrowed,noncash_message,noncash_edit_borrowed,noncash_edit_denomination,noncash_cbcheck)
{
  if(borrowed == 'YES')
  {
    $('#cancel_borrowed_ncbtn').prop('disabled', false);
  }
  else
  {
    $('#cancel_borrowed_ncbtn').prop('disabled', true);
  }

  if(noncash_edit_borrowed == 'DISABLED' || noncash_edit_borrowed == '')
  {
    $('#edit_borrowed_ncbtn').prop('disabled', false);
  }
  else
  {
    $('#edit_borrowed_ncbtn').prop('disabled', true);
  }

  if(noncash_edit_denomination == '')
  {
    $('#edit_cashier_ncden_btn').prop('disabled', false);
  }
  else
  {
    $('#edit_cashier_ncden_btn').prop('disabled', true);
  }

  if(noncash_message == 'NO DATA')
  {
    $('#thpncm_checkbox').prop('disabled', true);
    $('#refresh_noncash_btn').prop('disabled', true);
    $('#edit_cashier_ncden_btn').prop('disabled', true);
    $('#edit_borrowed_ncbtn').prop('disabled', true);
  }
  else
  {
    $('#thpncm_checkbox').prop('disabled', false);
    $('#refresh_noncash_btn').prop('disabled', false);
  }
  
  if(noncash_cbcheck != '')
  {
    var cbcheck = noncash_cbcheck.slice(0,-1);
    var check = cbcheck.split(',');
    for (let i=0; i<check.length; i++) {
      $('#pncm_checkbox'+check[i]).prop('checked', true);
    }
  }
}

function submit_cashierden_js()
{
  if($("#gt_vmodal").text() == 0)
  {
    Swal.fire('MISSING DATA', 'Please confirm first the cashier pending denomination before submit.', 'error');
    return; 
  }
  else if($("#pc_vmodal").text().split(",").join("").trim() > 0 && $("#fc_vmodal").text().split(",").join("").trim() < 1)
  {
    Swal.fire('MISSING FINAL CASH', 'Please liquidate the final remittance first before submit.', 'error');
    return;
  }
  else
  {
    var title = '<span style="color: red; font-weight: bold;">WARNING!</span>';
    var text = '';
    if($("#fc_vmodal").text().split(",").join("").trim() < 1)
    {
      text = 'Your FINAL CASH AMOUNT is 0, are you sure you want to submit this denomination as FINAL REMITTANCE?';
    }
    else if($("#tnc_vmodal").text().split(",").join("").trim() < 1)
    {
      text = 'Your NONCASH is 0, are you sure you want to submit this denomination as FINAL REMITTANCE?';
    }
    else if($("#pc_vmodal").text().split(",").join("").trim() < 1)
    {
      text = 'Your PARTIAL CASH AMOUNT is 0, are you sure you want to submit this denomination as FINAL REMITTANCE?';
    }
    else
    {
      text = 'Are you sure you want to submit this denomination as final remittance?';
    }
    // =================================================================================================================  
    Swal.fire({
    title: title,
    text: text,
    icon: 'warning',
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
        var gtotal = $("#gt_vmodal").text().split(',').join('');
        var rsales = $("#rs_variancemodal").val().split(',').join('');
        var discount = $("#wholesale_discount_variancemodal").val().split(',').join('');
        var tr_count = $("#tr_count_variancemodal").val().split(',').join('');
        var sop_no = $("#sop_vmodal").text().split(',').join('');
        
        if(sop_no < 0)
        {
          sop_no = sop_no.split('-').join('');
        }

        if(rsales < 1)
        {
          // for not disapear on clicking outside the modal
          $('#managers_key_modal').modal({
          backdrop: 'static',
          keyboard: false
          })
          // =================================================================
          $("#managers_key_modal").modal("show");
          $('#username').val('');
          $('#password').val('');
        }
        else
        {
            if($("#tr_count_variancemodal").val().split(",").join("").trim() == '')
            {
              Swal.fire('MISSING TRANSACTION COUNT', 'Please input transaction count first before submit.', 'error');
              return;
            }
            else if($("#tr_count_variancemodal").val().split(",").join("").trim() < 1)
            {
              Swal.fire('INVALID TRANSACTION COUNT', 'Transaction count not less than 1', 'error');
              return;
            }
            else
            {
                // ==============================================================================
                var info = $('#cashier_info').text().split('|');
                // ==============================================================================  
                $.ajax({
                    type:'post',
                    url: '<?php echo base_url(); ?>submit_cashierden_route', 
                    data: {'tr_no': info[0],
                            'emp_id': info[1],
                            'sscode': info[2],
                            'pos_name': info[3],
                            'borrowed': info[4],
                            'sales_date': info[5],
                            'gtotal': gtotal, 
                            'rsales': rsales.trim(), 
                            'sop_txt': $("#sop_vmodallbl").text(),
                            'sop_no': sop_no
                    },
                    dataType:'json',
                    success: function(data)
                    {console.log(data);
                      if(data == 'EXPIRED SESSION')
                      {
                        Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                        setTimeout(function() {
                          window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                        }, 1000);
                      }
                      else if(data == 'DISABLED')
                      {
                        Swal.fire('INVALID SUBMIT', 'Please confirm first the pending partial denomination before submit.', 'error');
                        return;
                      }
                      else if(data == 'MISMATCH')
                      {
                        Swal.fire('INVALID SUBMIT', 'Please check section and sub section of cash and noncash form not match.', 'error');
                        return;
                      }
                      else if(data == 'MISMATCH PARTIAL')
                      {
                        Swal.fire('INVALID SUBMIT', 'Please check section and sub section of cash and partial remit not match.', 'error');
                        return;
                      }
                      else if(data == 'PENDING CASH')
                      {
                        Swal.fire('INVALID SUBMIT', 'Please confirm first the pending cash denomination before submit.', 'error');
                        return;
                      }
                      else if(data == 'PENDING NONCASH')
                      {
                        Swal.fire('INVALID SUBMIT', 'Please confirm first the pending noncash denomination before submit.', 'error');
                        return;
                      }
                      else if(data == 'ALREADY LIQUIDATE')
                      {
                        Swal.fire('ALREADY LIQUIDATE', 'This denomination is already liquidate by another liquidation officer.', 'error');
                        setTimeout(function() {
                          window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                        }, 2500);
                      }
                      else
                      {
                        insert_csdata_denomination_js(data.trno,data.cid,data.ccode,data.bcode,data.dcode,data.scode,data.sscode,data.gtotal,data.rsales,discount,tr_count,info[3]);
                      }
                    }
                  });
              }
        }
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
  }
}

function insert_csdata_denomination_js(trno,cid,ccode,bcode,dcode,scode,sscode,gtotal,rsales,discount,tr_count,pos_name)
{
  var info = $('#cashier_info').text().split('|');
  // ==============================================================================
  $("#trno_txt").text(trno);
  // ==============================================================================
  $.ajax({
      type:'post',
      url: '<?php echo base_url(); ?>insert_csdata_denomination_route',
      data: {'trno': trno,
              'cid': cid,
              'ccode': ccode,
              'bcode': bcode,
              'dcode': dcode,
              'scode': scode,
              'sscode': sscode,
              'gtotal': gtotal,
              'rsales': rsales,
              'sales_date': info[5],
              'discount': discount,
              'tr_count': tr_count,
              'pos_name': pos_name
      },
      dataType:'json',
      success: function(data)
      {
        $('#submit_cashierden_btn').prop('disabled', true);
        $('#thpncm_checkbox').prop('disabled', true);
        $('#edit_cashier_ncden_btn').prop('disabled', true);
        $('#edit_borrowed_ncbtn').prop('disabled', true);
        $('#refresh_noncash_btn').prop('disabled', true);
        refresh_pendingmodal();
        Swal.fire('SUBMITTED', 'You can now print the cashier denomination.', 'success');
        setTimeout(function() {
          refresh_noncashpendingmodal_v2();
          $("#print_cashierden_btn").prop('disabled', false);
          print_submit_denominations_js(info[0],info[1],info[2],info[3],info[4],info[5]); 
          $("#pending_modal").modal("hide");
        }, 1500);
      }
  });
}

function print_submit_denominations_js(tr_no,emp_id,sscode,pos_name,borrowed,date)
{
  window.io = {
    open: function(verb, url, data, target){
        var form = document.createElement("form");
        form.action = url;
        form.method = verb;
        form.target = target || "_self";
        if (data) {
            for (var key in data) {
                var input = document.createElement("textarea");
                input.name = key;
                input.value = typeof data[key] === "object"
                    ? JSON.stringify(data[key])
                    : data[key];
                form.appendChild(input);
            }

        }
        form.style.display = 'none';
        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);
    }
  };
  
  io.open('POST', '<?php echo base_url('print_submit_denomination_route'); ?>', { tr_no: tr_no, emp_id: emp_id, sscode: sscode, pos_name: pos_name, borrowed: borrowed, date: date },'_blank');  
}

function print_transferred_js(trno,cashier_id)
{
  window.io = {
            open: function(verb, url, data, target){
                var form = document.createElement("form");
                form.action = url;
                form.method = verb;
                form.target = target || "_self";
                if (data) {
                    for (var key in data) {
                        var input = document.createElement("textarea");
                        input.name = key;
                        input.value = typeof data[key] === "object"
                            ? JSON.stringify(data[key])
                            : data[key];
                        form.appendChild(input);
                    }

                }
                form.style.display = 'none';
                document.body.appendChild(form);
                form.submit();
                document.body.removeChild(form);
            }
        };
  
  io.open('POST', '<?php echo base_url('print_cashierden_route'); ?>', { trno: trno, cashier_id: cashier_id },'_blank');  
}

function yes_checkall_js()
{
  if($(".th_yes_checkbox").prop("checked") == true)
  {
      $(".yes").prop("checked", true);
      $(".no").prop("checked", false);
      $(".th_no_checkbox").prop("checked", false);
  }
  else
  {
      $(".yes").prop("checked", false);
  }
}

function no_checkall_js()
{
  if($(".th_no_checkbox").prop("checked") == true)
  {
      $(".no").prop("checked", true);
      $(".yes").prop("checked", false);
      $(".th_yes_checkbox").prop("checked", false);
  }
  else
  {
      $(".no").prop("checked", false);
  }
}

function enable_edit_cash_pos_js()
{
    Swal.fire({
    title: 'Are you sure you want to enable cashier edit to counter no.?',
    icon: 'info',
    showDenyButton: true,
    /* showCancelButton: true,*/
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
    actions: 'my-actions',
    /*  cancelButton: 'order-1 right-gap',*/
    confirmButton: 'order-2',
    denyButton: 'order-3',
    }
    }).then((result) => {
      if (result.isConfirmed) 
      {  
        $.ajax({
                type:'post',
                url: '<?php echo base_url(); ?>enable_edit_cash_pos_route',
                data: {'cashier_id': $("#empid_cashlbl").text()},
                dataType:'json',
                success: function(data)
                {
                  if(data == 'EXPIRED SESSION')
                  {
                    Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                  
                    setTimeout(function() {
                      window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                      }, 1000);
                  }
                  else
                  {
                    Swal.fire('DONE', 'Cashier can start to edit counter no.', 'success');
                    $('#edit_cash_pos_btn').prop('disabled', true);
                  }
                }
              });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
}

function enable_edit_noncash_pos_js()
{
    Swal.fire({
    title: 'Are you sure you want to enable cashier edit counter no.?',
    icon: 'info',
    showDenyButton: true,
    /* showCancelButton: true,*/
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
    actions: 'my-actions',
    /*  cancelButton: 'order-1 right-gap',*/
    confirmButton: 'order-2',
    denyButton: 'order-3',
    }
    }).then((result) => {
      if (result.isConfirmed) 
      {  
        $.ajax({
                type:'post',
                url: '<?php echo base_url(); ?>enable_edit_noncash_pos_route',
                data: {'cashier_id': $("#noncash_empid").text()},
                dataType:'json',
                success: function(data)
                {
                  if(data == 'EXPIRED SESSION')
                  {
                    Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                  
                    setTimeout(function() {
                      window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                      }, 1000);
                  }
                  else
                  {
                    Swal.fire('DONE', 'Cashier can start to edit counter no.', 'success');
                    $('#edit_noncash_pos_btn').prop('disabled', true);
                  }
                }
              });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
}

function enable_add_mop_js()
{
    Swal.fire({
    title: 'Are you sure you want to enable cashier to add mode of payment?',
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
        // ==============================================================================
        var info = $('#cashier_info').text().split('|');
        // ==============================================================================  
        $.ajax({
                type:'post',
                url: '<?php echo base_url(); ?>enable_add_mop_route',
                data: {'tr_no': info[0],
                       'emp_id': info[1],
                       'sscode': info[2],
                       'pos_name': info[3],
                       'borrowed': info[4]
                },
                dataType:'json',
                success: function(data)
                {
                  if(data == 'EXPIRED SESSION')
                  {
                    Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                  
                    setTimeout(function() {
                      window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                    }, 1000);
                  }
                  else
                  {
                    Swal.fire('DONE', 'Cashier can start to add mode of payment.', 'success');
                    $('#add_mop_btn').prop('disabled', true);
                  }
                }
              });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
}

function checked_borrow()
{
  $("#cash_section").prop('disabled', false);
  $("#cash_subsection").prop('disabled', false);
  var borrow = document.getElementById("borrow_checkbox");
  if(borrow.checked)
  {
    document.getElementById("cash_section_form").hidden = false;

    $("#cash_section").html("");
    $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>get_section_route',
          dataType:'json',
          success: function(data)
          {                        
             $("#cash_section").html(data.html);
             get_sub_section_js();
          }
      })
  }
  else
  {
    document.getElementById("cash_section_form").hidden = true;
  } 
}

function get_sub_section_js()
{
  $("#cash_subsection").html("");
  $.ajax({
        type:'post',
        url :'<?php echo base_url(); ?>get_sub_section_route',
        data:{'section_code': $("#cash_section").val()},
        dataType:'json',
        success: function(data)
        {                  
            $("#cash_subsection").html(data.html);
        }
    })
}

function search_emp_js()
 {
    var availableTags = [];

    $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>liq_search_emp_route',
        data: {'emp_name': $("#emp_name").val(),
               'dcode': $("#dept_name option:selected").val()
              },
        dataType: 'json',
        success: function(data) 
        {
          if(data=='EXPIRED SESSION')
          {
             Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
           
             setTimeout(function() {
               window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
              }, 1000);
          }
          else
          {
                availableTags = data.emp_name.split('^');
                $( "#emp_name" ).autocomplete({
                  source: availableTags
                });
          }
        }
      });
 }

 function disabled_search_js()
 {
    if($("#dept_name option:selected").text() == '')
    {
      $("#set_counter_btn").prop('disabled', true);
      $("#emp_name").prop('disabled', true);
      $("#borrow_checkbox").prop('disabled', true);
      $("#pos_name").prop('disabled', true);
      $("#cash_section_form").prop('hidden', true);
      $("#borrow_checkbox").prop('checked', false);
      $("#pos_name").val('');
      $("#counter_no").text('');
    }
    else
    {
      $("#set_counter_btn").prop('disabled', false);
      $("#emp_name").prop('disabled', false);
      $("#borrow_checkbox").prop('disabled', false);
      $("#pos_name").prop('disabled', false);
      $("#emp_name").focus();
    }
 }

 function setup_counter_get_bunit_name_js()
 {
    $.ajax({
      type:'post',
      url: '<?php echo base_url(); ?>get_bunit_name_route',
      dataType:'json',
      success: function(data)
      {
        $("#bunit_name").html(data.bunit_name);
        setup_counter_get_dept_name_js();
      }
    });
  }

  function setup_counter_get_dept_name_js()
  {
    $("#emp_name").val('');
    $("#borrow_checkbox").prop('checked', false);
    $.ajax({
      type:'post',
      url: '<?php echo base_url(); ?>get_deptname_route',
      data: {'bcode': $("#bunit_name").val()},
      dataType:'json',
      success: function(data)
      {
        $("#dept_name").html(data.dept_name);
        display_pos_name_js();
        disabled_search_js();
      }
    });
  }

  function received_cash_get_bunit_name_js()
  {
    $.ajax({
      type:'post',
      url: '<?php echo base_url(); ?>get_bunit_name_route',
      dataType:'json',
      success: function(data)
      {
        $("#bunit_name").html(data.bunit_name);
        received_cash_get_dept_name_js();
      }
    });
  }

  function received_cash_get_dept_name_js()
  {
    $.ajax({
      type:'post',
      url: '<?php echo base_url(); ?>get_deptname_route',
      data: {'bcode': $("#bunit_name").val()},
      dataType:'json',
      success: function(data)
      {
        $("#dept_name").html(data.dept_name);
        received_cash_js();
      }
    });
  }

  function end_of_day_get_bunit_name_js()
  {
    $.ajax({
      type:'post',
      url: '<?php echo base_url(); ?>get_bunit_name_route',
      dataType:'json',
      success: function(data)
      {
        $("#bunit_name").html(data.bunit_name);
        end_of_day_get_dept_name_js();
      }
    });
  }

  function end_of_day_get_dept_name_js()
  {
    $.ajax({
      type:'post',
      url: '<?php echo base_url(); ?>get_deptname_route',
      data: {'bcode': $("#bunit_name").val()},
      dataType:'json',
      success: function(data)
      {
        $("#dept_name").html(data.dept_name);
      }
    });
  }

  function display_pos_name_js()
  {
    if($("#dept_name option:selected").text() != '')
    {
      $("#counter_no").text('');
      $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>setup_counter_display_pos_name_route',
          data: {'dcode': $("#dept_name option:selected").val()},
          dataType: 'json',
          success: function(data) {
              $("#pos_name").html(data.html);
          }
      });
    }
  }

  function get_counter_no_js()
  {
      if($("#pos_name option:selected").text() != 'Select POS')
      {
        var counter_no = $("#pos_name option:selected").val();
        $("#counter_no").text(counter_no);
      }
  }

  function unchecked_borrow_js()
  {
    $("#emp_name").val('');
    $("#borrow_checkbox").prop('checked', false);
    $("#cash_section_form").prop('hidden', true);
    $("#emp_name").focus();
    display_pos_name_js();
  }

  function setup_counter_checked_borrow()
  {
    $("#cash_section").prop('disabled', false);
    $("#cash_subsection").prop('disabled', false);
    var borrow = document.getElementById("borrow_checkbox");
    if(borrow.checked)
    {
      document.getElementById("cash_section_form").hidden = false;
      $("#cash_section").html("");
      $.ajax({
            type:'post',
            url :'<?php echo base_url(); ?>setup_counter_get_section_route',
            data: {'dcode': $("#dept_name option:selected").val()},
            dataType:'json',
            success: function(data)
            {                        
              $("#cash_section").html(data.html);
              setup_counter_get_sub_section_js();
            }
        })
    }
    else
    {
      document.getElementById("cash_section_form").hidden = true;
    } 
  }

  function setup_counter_get_sub_section_js()
  {
    $("#cash_subsection").html("");
    $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>setup_counter_get_sub_section_route',
          data:{'scode': $("#cash_section option:selected").val(),
                'dcode': $("#dept_name option:selected").val()
          },
          dataType:'json',
          success: function(data)
          {                  
              $("#cash_subsection").html(data.html);
          }
      })
  }

  function set_assigned_counter_js()
  {
    if($("#emp_name").val() == "")
    {
      Swal.fire('MISSING CASHIER', 'Please input cashier.', 'error');
      return;
    }
    else if($("#pos_name option:selected").text() == "Select POS")
    {
      Swal.fire('MISSING COUNTER', 'Please select counter.', 'error');
      return;
    }
    else
    {
      if($("#borrow_checkbox").prop('checked') == true && $("#cash_section option:selected").text() == 'SELECT SECTION')
      {
        Swal.fire('INVALID BORROWED', 'Please select section.', 'error');
        return;
      }
      else
      {
        Swal.fire({
        title: 'Are you sure you want to set this counter as default?',
        icon: 'warning',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
        customClass: {
        actions: 'my-actions',
        confirmButton: 'order-2',
        denyButton: 'order-3',
        }
        }).then((result) => {
          if (result.isConfirmed) {
            var borrow = 'NO';
            if($("#borrow_checkbox").prop('checked') == true)
            {
              borrow = 'YES';
              $.ajax({
                type:'post',
                url :'<?php echo base_url(); ?>set_assigned_counter_route',
                data:{'dcode': $("#dept_name option:selected").val(),
                      'name': $("#emp_name").val(),
                      'scode': $("#cash_section option:selected").val(),
                      'sscode': $("#cash_subsection option:selected").val(),
                      'pos_name': $("#pos_name option:selected").text(),
                      'counter_no': $("#counter_no").text(),
                      'borrow': borrow
                },
                dataType:'json',
                success: function(data)
                {                  
                  if(data=='EXPIRED SESSION')
                  {
                    Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                  
                    setTimeout(function() {
                      window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                      }, 1000);
                  }
                  else if(data == 'INVALID NAME')
                  {
                    Swal.fire('INVALID NAME', 'Please check cashier name', 'error')
                  }
                  else if(data == 'INVALID BORROWED')
                  {
                    Swal.fire('INVALID BORROWED', 'You selected his/her current section and sub section.', 'error')
                  }
                  else if(data == 'ALREADY EXIST')
                  {
                    Swal.fire('ALREADY EXIST', '', 'error')
                  }
                  else
                  {
                    cashier_assigned_counter_js();
                    Swal.fire('DONE', '', 'success')
                  }
                }
              })
            }
            else
            {
              $.ajax({
                type:'post',
                url :'<?php echo base_url(); ?>set_assigned_counter_route',
                data:{'dcode': $("#dept_name option:selected").val(),
                      'name': $("#emp_name").val(),
                      'pos_name': $("#pos_name option:selected").text(),
                      'counter_no': $("#counter_no").text(),
                      'borrow': borrow
                },
                dataType:'json',
                success: function(data)
                {             
                  if(data=='EXPIRED SESSION')
                  {
                    Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                  
                    setTimeout(function() {
                      window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                      }, 1000);
                  }
                  else if(data == 'INVALID NAME')
                  {
                    Swal.fire('INVALID NAME', 'Please check cashier name', 'error')
                  }
                  else if(data == 'INVALID BORROWED')
                  {
                    Swal.fire('INVALID BORROWED', 'You selected his/her current section and sub section.', 'error')
                  }
                  else if(data == 'ALREADY EXIST')
                  {
                    Swal.fire('ALREADY EXIST', '', 'error')
                  }
                  else
                  {
                    cashier_assigned_counter_js();
                    Swal.fire('DONE', '', 'success')
                  }
                }
              })
            }
          } else if (result.isDenied) {
            Swal.fire('CANCELLED', '', 'info')
          }
        })
      }
    }
  }

  function cashier_assigned_counter_js()
  {
    $("#divbody_cashier_assigned_counter").html("");
    $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>cashier_assigned_counter_route',
          dataType:'json',
          success: function(data)
          {                  
              $("#divbody_cashier_assigned_counter").html(data.html);
              assigned_counter_datatable();
          }
      })
  }

  function advance_set_assigned_counter_js()
  {
    // =============================================CURRENT DATE===============================================================
    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();
    var current_date = d.getFullYear() + '-' +
        ((''+month).length<2 ? '0' : '') + month + '-' +
        ((''+day).length<2 ? '0' : '') + day;
    // =========================================================================================================================
    var day2 = d.getDate() + 7;
    var maxdate = d.getFullYear() + '-' +
        ((''+month).length<2 ? '0' : '') + month + '-' +
        ((''+day2).length<2 ? '0' : '') + day2;
    var filter_date = $('#filter_date').val();
    // =========================================================================================================================
    if(filter_date <= current_date)
    {
      Swal.fire('INVALID DATE', 'Please select future date not previous or current date.', 'error');
      return;
    }
    else if(filter_date > maxdate)
    {
      Swal.fire('INVALID DATE', 'You\'ve reached the maximum date limit.', 'error');
      return;
    }
    else if($("#emp_name").val() == "")
    {
      Swal.fire('MISSING CASHIER', 'Please input cashier.', 'error');
      return;
    }
    else if($("#pos_name option:selected").text() == "Select POS")
    {
      Swal.fire('MISSING COUNTER', 'Please select counter.', 'error');
      return;
    }
    else
    {
      if($("#borrow_checkbox").prop('checked') == true && $("#cash_section option:selected").text() == 'SELECT SECTION')
      {
        Swal.fire('INVALID BORROWED', 'Please select section.', 'error');
        return;
      }
      else
      {
        Swal.fire({
        title: 'Are you sure you want to set this counter as default?',
        icon: 'warning',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
        customClass: {
        actions: 'my-actions',
        confirmButton: 'order-2',
        denyButton: 'order-3',
        }
        }).then((result) => {
          if (result.isConfirmed) {
            var borrow = 'NO';
            if($("#borrow_checkbox").prop('checked') == true)
            {
              borrow = 'YES';
              $.ajax({
                type:'post',
                url :'<?php echo base_url(); ?>advance_set_assigned_counter_route',
                data:{'dcode': $("#dept_name option:selected").val(),
                      'name': $("#emp_name").val(),
                      'scode': $("#cash_section option:selected").val(),
                      'sscode': $("#cash_subsection option:selected").val(),
                      'pos_name': $("#pos_name option:selected").text(),
                      'counter_no': $("#counter_no").text(),
                      'borrow': borrow,
                      'filter_date': filter_date
                },
                dataType:'json',
                success: function(data)
                {                  
                  if(data=='EXPIRED SESSION')
                  {
                    Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                  
                    setTimeout(function() {
                      window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                      }, 1000);
                  }
                  else if(data == 'INVALID NAME')
                  {
                    Swal.fire('INVALID NAME', 'Please check cashier name', 'error')
                  }
                  else if(data == 'INVALID BORROWED')
                  {
                    Swal.fire('INVALID BORROWED', 'You selected his/her current section and sub section.', 'error')
                  }
                  else if(data == 'ALREADY EXIST')
                  {
                    Swal.fire('ALREADY EXIST', '', 'error')
                  }
                  else
                  {
                    advance_cashier_assigned_counter_js();
                    Swal.fire('DONE', '', 'success')
                  }
                }
              })
            }
            else
            {
              $.ajax({
                type:'post',
                url :'<?php echo base_url(); ?>advance_set_assigned_counter_route',
                data:{'dcode': $("#dept_name option:selected").val(),
                      'name': $("#emp_name").val(),
                      'pos_name': $("#pos_name option:selected").text(),
                      'counter_no': $("#counter_no").text(),
                      'borrow': borrow,
                      'filter_date': filter_date
                },
                dataType:'json',
                success: function(data)
                {             
                  if(data=='EXPIRED SESSION')
                  {
                    Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                  
                    setTimeout(function() {
                      window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
                      }, 1000);
                  }
                  else if(data == 'INVALID NAME')
                  {
                    Swal.fire('INVALID NAME', 'Please check cashier name', 'error')
                  }
                  else if(data == 'INVALID BORROWED')
                  {
                    Swal.fire('INVALID BORROWED', 'You selected his/her current section and sub section.', 'error')
                  }
                  else if(data == 'ALREADY EXIST')
                  {
                    Swal.fire('ALREADY EXIST', '', 'error')
                  }
                  else
                  {
                    advance_cashier_assigned_counter_js();
                    Swal.fire('DONE', '', 'success')
                  }
                }
              })
            }
          } else if (result.isDenied) {
            Swal.fire('CANCELLED', '', 'info')
          }
        })
      }
    }
  }

  function advance_cashier_assigned_counter_js()
  {
    $("#divbody_cashier_assigned_counter").html("");
    $.ajax({
        type:'post',
        url :'<?php echo base_url(); ?>advance_cashier_assigned_counter_route',
        dataType:'json',
        success: function(data)
        {                  
            $("#divbody_cashier_assigned_counter").html(data.html);
            assigned_counter_datatable();
        }
    })
  }

  function assigned_counter_datatable() 
  {
      $(document).ready(function() {
        $('#cashier_assigned_counter_table').DataTable({
          "columnDefs": 
          [
            {"className": "text-center", "targets": [1,2]}
          ],
          "order": [
            [0, "asc"]
          ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
        });
      });
  }

  function view_counter_js(emp_id,name)
  {
    // for not disapear on clicking outside the modal
    $('#assigned_counter_modal').modal({
    backdrop: 'static',
    keyboard: false
    })
    // =================================================================
     $("#assigned_counter_modal").modal("show");
     $("#header_modal").text(name);

     $("#assigned_counter_bodymodal").html("");
     $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>view_counter_route',
          data:{'emp_id': emp_id},
          dataType:'json',
          success: function(data)
          {                  
              $("#assigned_counter_bodymodal").html(data.html);
              view_counter_datatable();
          }
      })
  }

  function view_counter_datatable() 
  {
      $(document).ready(function() {
        $('#view_assigned_counter_table').DataTable({
          "columnDefs": 
          [
            {"className": "text-center", "targets": [0,1,2,3,4,5]}
          ],
          "order": [
            [1, "asc"]
          ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
        });
      });
  }

  function advance_view_counter_js(emp_id,name)
  {
    // for not disapear on clicking outside the modal
    $('#assigned_counter_modal').modal({
    backdrop: 'static',
    keyboard: false
    })
    // =================================================================
     $("#assigned_counter_modal").modal("show");
     $("#header_modal").text(name);

     $("#assigned_counter_bodymodal").html("");
     $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>view_advance_counter_route',
          data:{'emp_id': emp_id},
          dataType:'json',
          success: function(data)
          {                  
              $("#assigned_counter_bodymodal").html(data.html);
              view_advance_counter_datatable();
          }
      })
  }

  function view_advance_counter_datatable() 
  {
      $(document).ready(function() {
        $('#view_assigned_counter_table').DataTable({
          "columnDefs": 
          [
            {"className": "text-center", "targets": [0,1,2,3,4,5,6]}
          ],
          "order": [
            [5, "asc"], [ 1, 'asc' ]
          ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
        });
      });
  }

  function update_default_counter_js(id,emp_id,dcode)
  {
    Swal.fire({
    title: 'Are you sure you want to set this counter as default?',
    icon: 'warning',
    showDenyButton: true,
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
    actions: 'my-actions',
    confirmButton: 'order-2',
    denyButton: 'order-3',
    }
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>update_default_counter_route',
          data:{'id': id,
                'emp_id': emp_id,
                'dcode': dcode
          },
          dataType:'json',
          success: function(data)
          {     
              view_counter_js(emp_id);
              Swal.fire('DONE', '', 'success')
          }
        })
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
  }

  function update_advance_default_counter_js(id,emp_id,dcode,date_setup)
  {
    Swal.fire({
    title: 'Are you sure you want to set this counter as default?',
    icon: 'warning',
    showDenyButton: true,
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
    actions: 'my-actions',
    confirmButton: 'order-2',
    denyButton: 'order-3',
    }
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>update_advance_default_counter_route',
          data:{'id': id,
                'emp_id': emp_id,
                'dcode': dcode,
                'date_setup': date_setup
          },
          dataType:'json',
          success: function(data)
          {     
              advance_view_counter_js(emp_id);
              Swal.fire('DONE', '', 'success')
          }
        })
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
  }

  function remit_to_treasury_js()
  {
      var check = $("input[class='td_checkbox']:checked").map(function() {
        return this.value;
      }).get();
      // ==========================================================================
      if(check == '')
      {
        Swal.fire('MISSING DATA', 'Please select cash to remit before click remit to treasury button.', 'error')
      }
      else
      {
        // for not disapear on clicking outside the modal
        $('#remit_to_treasury_modal').modal({
        backdrop: 'static',
        keyboard: false
        })
        // =================================================================
        $("#remit_to_treasury_modal").modal("show");
        var bname = $("#bunit_name option:selected").text();
        var dname = $("#dept_name option:selected").text();
        var dcode = $("#dept_name option:selected").val();
        $("#bname").text(bname);
        $("#dname").text(dname);
        $("#dcode").text(dcode);
        $("#remit_to_treasury_bodymodal").html("");
        // =================================================================
        $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>view_remit_modal_route', 
          data:{'id': check,
                'dcode': dcode
          },
          dataType:'json',
          success: function(data)
          {                  
              $("#selected_id").text(check);
              $("#batch_no").text(data.batch_remit);
              $("#remit_to_treasury_bodymodal").html(data.html);
              selected_cash_datatable(); 
          }
        })
      }
  }

  function selected_cash_datatable() 
  {
      $(document).ready(function() {
        $('#selected_cash_table').DataTable({
          "columnDefs": 
          [
            {"className": "text-center", "targets": [1,2,3]}
          ],
          "order": [
            [2, "desc"], [ 0, 'asc' ]
          ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
        });
      });
  }

  function checked_partial()
  {
      document.getElementById("final_checkbox").checked = false;
  }

  function checked_final()
  {
      document.getElementById("partial_checkbox").checked = false;
  }  

  function remit_selected_cash_js()
  { 
    Swal.fire({
      title: 'Are you sure you want to remit?',
      icon: 'warning',
      showDenyButton: true,
      confirmButtonText: 'Yes',
      denyButtonText: 'No',
      customClass: {
      actions: 'my-actions',
      confirmButton: 'order-2',
      denyButton: 'order-3',
      }
    }).then((result) => {
      if (result.isConfirmed) {
        // ==========================================================================
        var id = $("#selected_id").text();
        var dcode = $("#dcode").text();
        // ==========================================================================
        $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>remit_selected_cash_route', 
          data:{'id': id,
                'dcode': dcode
          },
          dataType:'json',
          success: function(data)
          {                  
            if(data=='EXPIRED SESSION')
            {
              Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
              setTimeout(function() {
                window.parent.location.href = "<?php echo base_url() ?>received_cash_route";
              }, 1000);
            }
            else if(data == 'ALREADY REMITTED')
            {
              Swal.fire('ALREADY REMITTED', '', 'error')
              setTimeout(function() {
                window.parent.location.href = "<?php echo base_url() ?>received_cash_route";
              }, 2500);
            }
            else
            {
              Swal.fire('REMITTED', '', 'success');
              $('#remit_to_treasury_modal').modal('toggle');
              setTimeout(function() {
                received_cash_js(); 
                print_liquidation_partial_cash_js(id);
              }, 1500);
            }
          }
        })
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
  }

  function view_batch_partial_remitted_js(batch_id,batch_remit)
  {
    // for not disapear on clicking outside the modal
    $('#partial_remitted_modal').modal({
      backdrop: 'static',
      keyboard: false
    })
    // =================================================================
    $("#partial_remitted_modal").modal("show");
    $("#batch_header_modal").text(batch_remit);
    $("#partial_remitted_bodymodal").html("");
    // =================================================================
    $.ajax({
      type:'post',
      url :'<?php echo base_url(); ?>view_batch_partial_remitted_route', 
      data:{'id': batch_id},
      dataType:'json',
      success: function(data)
      {    
          $("#partial_remitted_bodymodal").html(data.html);
          partial_remitted_datatable(); 
      }
    })
  }

  function refresh_batch_partial_remitted_js(batch_id)
  {
    $("#partial_remitted_bodymodal").html("");
    // =================================================================
    $.ajax({
      type:'post',
      url :'<?php echo base_url(); ?>view_batch_partial_remitted_route', 
      data:{'id': batch_id},
      dataType:'json',
      success: function(data)
      {    
          $("#partial_remitted_bodymodal").html(data.html);
          partial_remitted_datatable(); 
      }
    })
  }

  function partial_remitted_datatable() 
  {
    $(document).ready(function() {
      $('#selected_cash_table').DataTable({
        "columnDefs": 
        [
          {"className": "text-center", "targets": [1,2,3,4,5]}
        ],
        "order": [
          [2, "desc"], [ 0, 'asc' ]
        ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
      });
    });
  }

  function print_liquidation_partial_cash_js(id)
  { 
    window.io = {
      open: function(verb, url, data, target){
          var form = document.createElement("form");
          form.action = url;
          form.method = verb;
          form.target = target || "_self";
          if (data) {
              for (var key in data) {
                  var input = document.createElement("textarea");
                  input.name = key;
                  input.value = typeof data[key] === "object"
                      ? JSON.stringify(data[key])
                      : data[key];
                  form.appendChild(input);
              }
          }
          form.style.display = 'none';
          document.body.appendChild(form);
          form.submit();
          document.body.removeChild(form);
      }
    };
    
    io.open('POST', '<?php echo base_url('print_liquidation_partial_cash_route'); ?>', { id: id },'_blank');  
  }

  function print_end_of_day_report_js()
  { 
    window.io = {
      open: function(verb, url, data, target){
          var form = document.createElement("form");
          form.action = url;
          form.method = verb;
          form.target = target || "_self";
          if (data) {
              for (var key in data) {
                  var input = document.createElement("textarea");
                  input.name = key;
                  input.value = typeof data[key] === "object"
                      ? JSON.stringify(data[key])
                      : data[key];
                  form.appendChild(input);
              }
          }
          form.style.display = 'none';
          document.body.appendChild(form);
          form.submit();
          document.body.removeChild(form);
      }
    };
    // =====================================================
    var date = $("#filter_date").val();
    var bcode = $("#bunit_name option:selected").val();
    var dcode = $("#dept_name option:selected").val();
    // =====================================================
    $.ajax({
      type:'post',
      url :'<?php echo base_url(); ?>validate_end_of_day_report_route', 
      data:{'date': date,
            'dcode': dcode
      },
      dataType:'json',
      success: function(data)
      {    
          if(data == 'NO DATA')
          {
            Swal.fire('NO DATA', '', 'error')
          }
          else if(data == 'PENDING CASH')
          {
            Swal.fire('PENDING CASH', 'You have a pending cash denomination, please remit your pending cash first before print end of day report.', 'error')
          }
          else if(data == 'PENDING NONCASH')
          {
            Swal.fire('PENDING NONCASH', 'You have a pending noncash denomination, please liquidate the cashier\'s pending denomination first beofre print end of day report.', 'error')
          }
          else
          {
            io.open('POST', '<?php echo base_url('print_end_of_day_report_route'); ?>', { date: date, bcode: bcode, dcode: dcode },'_blank');  
          }
      }
    })
  }

  function edit_pendingbtn_js(tr_no,emp_id,sscode,pos_name,name,sales_date)
  {
    // for not disapear on clicking outside the modal
    $('#sales_date_adjustment_modal').modal({
    backdrop: 'static',
    keyboard: false
    })
    // =================================================================
     var info = tr_no+'|'+emp_id+'|'+sscode+'|'+pos_name+'|'+sales_date;
     $("#sales_date_adjustment_modal").modal("show");
     $('#name_header').text(name);
     $('#cashier_info').text(info);
     $('#deleted_date').text(sales_date);
  }

  function change_sales_date_js()
  {
    Swal.fire({
      title: 'Are you sure you want to set this as sales date?',
      icon: 'warning',
      showDenyButton: true,
      confirmButtonText: 'Yes',
      denyButtonText: 'No',
      customClass: {
      actions: 'my-actions',
      confirmButton: 'order-2',
      denyButton: 'order-3',
      }
    }).then((result) => {
      if (result.isConfirmed) {
        var info = $("#cashier_info").text().split('|');
        $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>change_sales_date_route', 
          data:{'tr_no': info[0],
                'emp_id': info[1],
                'sscode': info[2],
                'pos_name': info[3],
                'sales_date': info[4]
          },
          dataType:'json',
          success: function(data)
          {    
            if(data=='EXPIRED SESSION')
            {
              Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
              setTimeout(function() {
                window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
              }, 1000);
            }
            else
            {
              view_pendingdenomination_js();
              $('#sales_date_adjustment_modal').modal().hide();
              Swal.fire('DONE!', '', 'success');
            }
          }
        })
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
  }

  function adjustment_pending_cash_js()
  {
    $('#divbody_pending_dentable').html('');
    $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>adjustment_pending_cash_route',
          dataType: 'json',
          success: function(data) {
            $('#divbody_pending_dentable').html(data.html);
            adjustment_pending_cash_datatable();
          }
    });
  }

  function adjustment_pending_cash_datatable() 
  {
    $(document).ready(function() {
      $('#pending_den_table').DataTable({
        "columnDefs": 
        [
          {"className": "text-center", "targets": [0,1,2,3,4,5,6,7]}
        ],
        "order": [
          [3, "desc"], [0, "asc"]
        ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
      });
    });
  }

  function adjustment_pending_noncash_js()
  {
    $('#divbody_pending_dentable').html('');
    $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>adjustment_pending_noncash_route',
          dataType: 'json',
          success: function(data) {
            $('#divbody_pending_dentable').html(data.html);
            adjustment_pending_noncash_datatable();
          }
    });
  }

  function adjustment_pending_noncash_datatable() 
  {
    $(document).ready(function() {
      $('#pending_den_table').DataTable({
        "columnDefs": 
        [
          {"className": "text-center", "targets": [0,1,2,3,4,5,6,7,8]}
        ],
        "order": [
          [3, "desc"], [0, "asc"]
        ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
      });
    });
  }

  function deleted_pending_cash_js()
  {
    $('#divbody_deleted_pending_dentable').html('');
    $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>get_deleted_pending_cash_route',
          dataType: 'json',
          success: function(data) {
            $('#divbody_deleted_pending_dentable').html(data.html);
            deleted_pending_cash_datatable();
          }
    });
  }

  function deleted_pending_cash_datatable() 
  {
    $(document).ready(function() {
      $('#deleted_pending_den_table').DataTable({
        "columnDefs": 
        [
          {"className": "text-center", "targets": [0,1,2,3,4,5,6,7,8]}
        ],
        "order": [
          [3, "desc"], [0, "asc"]
        ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
      });
    });
  }

  function get_deleted_posted_js()
  {
    $('#divbody_deleted_posted_dentable').html('');
    $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>get_deleted_posted_denomination_route',
          dataType: 'json',
          success: function(data) {
            $('#divbody_deleted_posted_dentable').html(data.html);
            deleted_posted_datatable();
          }
    });
  }

  function deleted_posted_datatable() 
  {
    $(document).ready(function() {
      $('#deleted_posted_den_table').DataTable({
        "columnDefs": 
        [
          {"className": "text-center", "targets": [0,1,2,3,4,5,6,7,8,9,10,11]}
        ],
        "order": [
          [3, "desc"], [0, "asc"]
        ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
      });
    });
  }

  function view_managers_key_js(id)
  {
     // for not disapear on clicking outside the modal
     $('#managers_key_modal').modal({
     backdrop: 'static',
     keyboard: false
     })
    // =================================================================
     $("#managers_key_modal").modal("show");
     $('#pending_id').text(id);
     $('#username').val('');
     $('#password').val('');
  }

  function delete_pending_cash_js()
  {
    var title = '<span style="color: red;">WARNING!</span>';
    Swal.fire({
    title: title,
    text: 'Are you sure you want to delete this cashier denomination?',
    icon: 'warning',
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
            type: 'post',
            url: '<?php echo base_url(); ?>delete_pending_denomination_route',
            data: {'id': $("#pending_id").text(),
                   'username': $("#username").val(),
                   'password': $("#password").val()
            },
            dataType: 'json',
            success: function(data) {
              if(data=='EXPIRED SESSION')
              {
                  Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                
                  setTimeout(function() {
                    window.parent.location.href = "<?php echo base_url() ?>adjustment_cash_route";
                  }, 1000);
              }
              else if(data == 'EMPTY')
              {
                Swal.fire('MISMATCH', 'Invalid username and password.', 'error')
              }
              else if(data == 'INVALID SUBORDINATES')
              {
                Swal.fire('INVALID SUBORDINATES', '', 'error')
              }
              else
              {
                adjustment_pending_cash_js();
                $('#managers_key_modal').modal('toggle');
                Swal.fire('DELETED', '', 'success')
              }
            }
          });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
  }

  function delete_pending_noncash_js(id)
  {
    var title = '<span style="color: red;">WARNING!</span>';
    Swal.fire({
    title: title,
    text: 'Are you sure you want to delete this noncash?',
    icon: 'warning',
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
            type: 'post',
            url: '<?php echo base_url(); ?>delete_pending_noncash_route',
            data: {'id': id},
            dataType: 'json',
            success: function(data) {
              if(data=='EXPIRED SESSION')
              {
                  Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                
                  setTimeout(function() {
                    window.parent.location.href = "<?php echo base_url() ?>adjustment_cash_route";
                  }, 1000);
              }
              else
              {
                adjustment_pending_noncash_js();
                Swal.fire('DELETED', '', 'success')
              }
            }
          });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
  }

  function delete_pending_cash_js_v2(id)
  {
    var title = '<span style="color: red;">WARNING!</span>';
    Swal.fire({
    title: title,
    text: 'Are you sure you want to delete this cashier denomination?',
    icon: 'warning',
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
            type: 'post',
            url: '<?php echo base_url(); ?>delete_pending_denomination_route_v2',
            data: {'id': id},
            dataType: 'json',
            success: function(data) {
              if(data=='EXPIRED SESSION')
              {
                  Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                
                  setTimeout(function() {
                    window.parent.location.href = "<?php echo base_url() ?>adjustment_cash_route";
                  }, 1000);
              }
              else
              {
                adjustment_pending_cash_js();
                Swal.fire('DELETED', '', 'success')
              }
            }
          });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
  }

  function delete_posted_denomination_js()
  {
    var title = '<span style="color: red;">WARNING!</span>';
    Swal.fire({
    title: title,
    text: 'Deleting posted denomination is a big impact to the report, all connected denomination of the cashier to this POS today will be deleted, after delete please inform cashier to input back all his/her correct denomination.',
    icon: 'warning',
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
        // ============================================================================================
        var info = $("#posted_info").text().split('|');
        // ============================================================================================
        $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>delete_posted_denomination_route',
          data: {'tr_no': info[0],
                 'emp_id': info[1],
                 'sscode': info[2],
                 'pos_name': info[3],
                 'sales_date': info[4],
                 'username': $("#username").val(),
                 'password': $("#password").val()
          },
          dataType: 'json',
          success: function(data) {
            if(data=='EXPIRED SESSION')
            {
                Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
              
                setTimeout(function() {
                  window.parent.location.href = "<?php echo base_url() ?>adjustment_posted__route";
                }, 1000);
            }
            else if(data == 'EMPTY')
            {
              Swal.fire('MISMATCH', 'Invalid username and password.', 'error')
            }
            else if(data == 'INVALID SUBORDINATES')
            {
              Swal.fire('INVALID SUBORDINATES', '', 'error')
            }
            else
            {
              posted_denomination_js();
              $('#managers_key_modal').modal('toggle');
              Swal.fire('DELETED', '', 'success')
            }
          }
        });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
  }

  function posted_denomination_js()
  {
    $('#divbody_posted_dentable').html('');
    $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>posted_denomination_route',
          dataType: 'json',
          success: function(data) {
            $('#divbody_posted_dentable').html(data.html);
            posted_denomination_datatable();
          }
    });
  }

  function posted_denomination_datatable() 
  {
    $(document).ready(function() {
      $('#posted_den_table').DataTable({
        "columnDefs": 
        [
          {"className": "text-center", "targets": [0,1,2,3,4,5,6,7,8,9]}
        ],
        "order": [
          [3, "desc"], [0, "asc"]
        ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
      });
    });
  }

  function posted_zero_registered_sales_js()
  {
    $('#divbody_posted_zero_rs_table').html('');
    $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>posted_zero_registered_sales_route',
          dataType: 'json',
          success: function(data) {
            $('#divbody_posted_zero_rs_table').html(data.html);
            posted_zero_rs_datatable();
          }
    });
  }

  function posted_zero_rs_datatable() 
  {
    $(document).ready(function() {
      $('#posted_zero_rs_table').DataTable({
        "columnDefs": 
        [
          {"className": "text-center", "targets": [0,1,2,3,4,5,6,7,8,9]}
        ],
        "order": [
          [3, "desc"], [0, "asc"]
        ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
      });
    });
  }

  function sales_date_adjustment_table_js()
  {
    $('#divbody_sales_date_adjustment_table').html('');
    $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>sales_date_adjustment_table_route',
          dataType: 'json',
          success: function(data) {
            $('#divbody_sales_date_adjustment_table').html(data.html);
            sales_date_adjustment_datatable();
          }
    });
  }

  function sales_date_adjustment_datatable() 
  {
    $(document).ready(function() {
      $('#sales_date_adjustment_table').DataTable({
        "columnDefs": 
        [
          {"className": "text-center", "targets": [0,1,2,3,4,5,6,7,8,9]}
        ],
        "order": [
          [3, "desc"], [0, "asc"]
        ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
      });
    });
  }

  function adjusted_zero_registered_sales_js()
  {
    $('#divbody_adjusted_zero_rs_table').html('');
    $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>adjusted_zero_registered_sales_route',
          dataType: 'json',
          success: function(data) {
            $('#divbody_adjusted_zero_rs_table').html(data.html);
            adjusted_zero_rs_datatable();
          }
    });
  }

  function adjusted_zero_rs_datatable() 
  {
    $(document).ready(function() {
      $('#adjusted_zero_rs_table').DataTable({
        "columnDefs": 
        [
          {"className": "text-center", "targets": [0,1,2,3,4,5,6,7,8,9,10,11]}
        ],
        "order": [
          [3, "desc"], [0, "asc"]
        ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
      });
    });
  }

  function adjusted_sales_date_js()
  {
    $('#divbody_adjusted_sales_date_table').html('');
    $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>get_adjusted_sales_date_route',
          dataType: 'json',
          success: function(data) {
            $('#divbody_adjusted_sales_date_table').html(data.html);
            adjusted_sales_date_datatable();
          }
    });
  }

  function adjusted_sales_date_datatable() 
  {
    $(document).ready(function() {
      $('#adjusted_sales_date_table').DataTable({
        "columnDefs": 
        [
          {"className": "text-center", "targets": [0,1,2,3,4,5,6,7,8,9,10,11,12]}
        ],
        "order": [
          [4, "desc"], [0, "asc"]
        ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
      });
    });
  }

  function view_mkey_posted_denomination_js(tr_no,emp_id,sscode,pos_name,sales_date)
  {
    // for not disapear on clicking outside the modal
    $('#managers_key_modal').modal({
      backdrop: 'static',
      keyboard: false
      })
    // =================================================================
      var info = tr_no+'|'+emp_id+'|'+sscode+'|'+pos_name+'|'+sales_date;
      $("#managers_key_modal").modal("show");
      $('#posted_info').text(info);
      $('#username').val('');
      $('#password').val('');
  }

  function remitted_cash_mkey_js(remitted_id,cash_id,tr_no,emp_id,sscode,pos_name,sales_date,type,id)
  {
    // for not disapear on clicking outside the modal
    $('#managers_key_modal').modal({
      backdrop: 'static',
      keyboard: false
      })
    // =================================================================
      var info = remitted_id+'|'+tr_no+'|'+emp_id+'|'+sscode+'|'+pos_name+'|'+sales_date+'|'+type+'|'+cash_id+'|'+id;
      $("#managers_key_modal").modal("show");
      $('#remitted_info').text(info);
      $('#username').val('');
      $('#password').val('');
  }

  function delete_remitted_cash_js()
  {
    var title = '<span style="color: red;">WARNING!</span>';
    Swal.fire({
    title: title,
    text: 'Deleting remitted denomination is a big impact to the report, all connected denomination of the cashier to this POS today will be deleted, after delete please inform cashier to input back all his/her correct denomination.',
    icon: 'warning',
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
        // ============================================================================================
        var info = $("#remitted_info").text().split('|');
        // ============================================================================================
        $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>delete_remitted_cash_route',
          data: {'remitted_id': info[0],
                 'cash_id': info[7],
                 'tr_no': info[1],
                 'emp_id': info[2],
                 'sscode': info[3],
                 'pos_name': info[4],
                 'sales_date': info[5],
                 'remit_type': info[6],
                 'username': $("#username").val(),
                 'password': $("#password").val()
          },
          dataType: 'json',
          success: function(data) {
            if(data=='EXPIRED SESSION')
            {
                Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
              
                setTimeout(function() {
                  window.parent.location.href = "<?php echo base_url() ?>adjustment_cash_route";
                }, 1000);
            }
            else if(data == 'EMPTY')
            {
              Swal.fire('MISMATCH', 'Invalid username and password.', 'error')
            }
            else if(data == 'INVALID SUBORDINATES')
            {
              Swal.fire('INVALID SUBORDINATES', '', 'error')
            }
            else
            {
              $('#managers_key_modal').modal('toggle');
              refresh_batch_partial_remitted_js(info[8]);
              partial_remitted_cash_js();
              Swal.fire('DELETED', '', 'success')
            }
          }
        });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
  }

  function validate_supervisor_approve_js()
  {
    var title = '<span style="color: red;">WARNING!</span>';
    Swal.fire({
    title: title,
    text: 'Are you sure you want to approve 0 registered sales?',
    icon: 'warning',
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
        // ============================================================================================
        var info = $("#remitted_info").text().split('|');
        // ============================================================================================
        $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>validate_supervisor_approve_route',
          data: {'username': $("#username").val(),
                 'password': $("#password").val()
          },
          dataType: 'json',
          success: function(data) {
            if(data=='EXPIRED SESSION')
            {
                Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
              
                setTimeout(function() {
                  window.parent.location.href = "<?php echo base_url() ?>adjustment_cash_route";
                }, 1000);
            }
            else if(data == 'EMPTY')
            {
              Swal.fire('MISMATCH', 'Invalid username and password.', 'error')
            }
            else if(data == 'INVALID SUBORDINATES')
            {
              Swal.fire('INVALID SUBORDINATES', '', 'error')
            }
            else
            {
              $('#managers_key_modal').modal('toggle');
              approved_zero_registered_sales_js(data);
            }
          }
        });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
  }

  function approved_zero_registered_sales_js(sup_id)
  {
    // ==============================================================================
    var gtotal = $("#gt_vmodal").text().split(',').join('');
    var discount = $("#wholesale_discount_variancemodal").val().split(',').join('');
    var tr_count = $("#tr_count_variancemodal").val().split(',').join('');
    var sop_no = $("#sop_vmodal").text().split(',').join('');
    var info = $('#cashier_info').text().split('|');
    // ==============================================================================  
    $.ajax({
        type:'post',
        url: '<?php echo base_url(); ?>submit_cashierden_zero_rs_route', 
        data: {'tr_no': info[0],
                'emp_id': info[1],
                'sscode': info[2],
                'pos_name': info[3],
                'borrowed': info[4],
                'sales_date': info[5],
                'gtotal': gtotal, 
                'rsales': '0', 
                'sop_txt': $("#sop_vmodallbl").text(),
                'sop_no': sop_no
        },
        dataType:'json',
        success: function(data)
        {console.log(data);
          if(data == 'EXPIRED SESSION')
          {
            Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
            setTimeout(function() {
              window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
            }, 1000);
          }
          else if(data == 'DISABLED')
          {
            Swal.fire('INVALID SUBMIT', 'Please confirm first the pending partial denomination before submit.', 'error');
            return;
          }
          else if(data == 'MISMATCH')
          {
            Swal.fire('INVALID SUBMIT', 'Please check section and sub section of cash and noncash form not match.', 'error');
            return;
          }
          else if(data == 'MISMATCH PARTIAL')
          {
            Swal.fire('INVALID SUBMIT', 'Please check section and sub section of cash and partial remit not match.', 'error');
            return;
          }
          else if(data == 'PENDING CASH')
          {
            Swal.fire('INVALID SUBMIT', 'Please confirm first the pending cash denomination before submit.', 'error');
            return;
          }
          else if(data == 'PENDING NONCASH')
          {
            Swal.fire('INVALID SUBMIT', 'Please confirm first the pending noncash denomination before submit.', 'error');
            return;
          }
          else if(data == 'ALREADY LIQUIDATE')
          {
            Swal.fire('ALREADY LIQUIDATE', 'This denomination is already liquidate by another liquidation officer.', 'error');
            setTimeout(function() {
              window.parent.location.href = "<?php echo base_url() ?>liq_domination_route";
            }, 2500);
          }
          else
          {
            insert_csdata_denomination_zero_rs_js(data.trno,data.cid,data.ccode,data.bcode,data.dcode,data.scode,data.sscode,data.gtotal,data.rsales,discount,tr_count,sup_id,info[3]);
          }
        }
      });
  }

  function insert_csdata_denomination_zero_rs_js(trno,cid,ccode,bcode,dcode,scode,sscode,gtotal,rsales,discount,tr_count,sup_id,pos_name)
  {
    var info = $('#cashier_info').text().split('|');
    // ==============================================================================
    $("#trno_txt").text(trno);
    // ==============================================================================
    $.ajax({
        type:'post',
        url: '<?php echo base_url(); ?>insert_csdata_denomination_zero_rs_route',
        data: {'trno': trno,
                'cid': cid,
                'ccode': ccode,
                'bcode': bcode,
                'dcode': dcode,
                'scode': scode,
                'sscode': sscode,
                'gtotal': gtotal,
                'rsales': rsales,
                'sales_date': info[5],
                'discount': discount,
                'tr_count': tr_count,
                'sup_id': sup_id,
                'pos_name': pos_name
        },
        dataType:'json',
        success: function(data)
        {
          $('#submit_cashierden_btn').prop('disabled', true);
          $('#thpncm_checkbox').prop('disabled', true);
          $('#edit_cashier_ncden_btn').prop('disabled', true);
          $('#edit_borrowed_ncbtn').prop('disabled', true);
          $('#refresh_noncash_btn').prop('disabled', true);
          refresh_pendingmodal();
          Swal.fire('SUBMITTED', 'You can now print the cashier denomination.', 'success');
          setTimeout(function() {
            refresh_noncashpendingmodal_v2();
            $("#print_cashierden_btn").prop('disabled', false);
            print_submit_denominations_js(info[0],info[1],info[2],info[3],info[4],info[5]); 
            $("#pending_modal").modal("hide");
          }, 1500);
        }
    });
  }

  function close_mkey_modal_js()
  {
    $('#managers_key_modal').modal('toggle');
  }

  function view_rs_adjustment_modal_js(data_id,den_id,tr_no,emp_id,emp_name,ccode,bcode,sscode,pos_name,borrowed,sales_date,total_sales)
  {
    // for not disapear on clicking outside the modal
    $('#zero_rs_adjustment_modal').modal({
      backdrop: 'static',
      keyboard: false
    })
    // =================================================================
    var info = data_id+'|'+den_id+'|'+tr_no+'|'+emp_id+'|'+ccode+'|'+bcode+'|'+sscode+'|'+pos_name+'|'+borrowed+'|'+sales_date;
    $("#zero_rs_adjustment_modal").modal("show");
    $('#cashier_info').text(info);
    $('#cashier_name').text(emp_name);
    $('#total_sales').val(total_sales);
    $('#registered_sales').val('');
    $('#zero_rs_variance').val('');
    $('#variance_txt').text('Variance:');
  }

  function view_sales_date_adjustment_modal_js(tr_no,emp_id,emp_name,dcode,sscode)
  {
    // for not disapear on clicking outside the modal
    $('#sales_date_adjustment_modal').modal({
      backdrop: 'static',
      keyboard: false
    })
    // =================================================================
    var info = tr_no+'|'+emp_id+'|'+dcode+'|'+sscode;
    $("#sales_date_adjustment_modal").modal("show");
    $('#cashier_info').text(info);
    $('#cashier_name').text(emp_name);
  }

  function backdate_batch_remittance_js(cashier_info,batch)
  {
    // for not disapear on clicking outside the modal
    $('#batch_sales_date_adjustment_modal').modal({
      backdrop: 'static',
      keyboard: false
    })
    // =================================================================
    $("#batch_sales_date_adjustment_modal").modal("show");
    $('#cashier_info').text(cashier_info);
    $('#batch').text(batch);
  }

  function zero_rs_compute_variance_js()
  {
    var total_sales = $('#total_sales').val().split(',').join('');
    var registered_sales = $('#registered_sales').val().split(',').join('');
    var variance = parseFloat(total_sales) - parseFloat(registered_sales);
    variance = variance.toFixed(2);
    if(variance == 0)
    {
      $('#variance_txt').text('No Variance:');
    }
    else if(variance < 0)
    {
      $('#variance_txt').text('Short:');
    }
    else if(variance > 0)
    {
      $('#variance_txt').text('Over:');
    }
    variance = variance.split('-').join('');
    variance = variance.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    $('#zero_rs_variance').val(variance);
  }

  function view_mkey_modal_adjust_zero_rs_js()
  {
    if($("#registered_sales").val() == '' || $("#registered_sales").val() <= 0)
    {
      Swal.fire('MISSING REGISTERED SALES', 'Please input registered sales before adjust.', 'error')
      return;
    }
    else if($("#tr_count").val() == '' || $("#registered_sales").val() <= 0)
    {
      Swal.fire('MISSING TRANSACTION COUNT', 'Please input transaction count before adjust.', 'error')
      return;
    }
    else
    {
      // for not disapear on clicking outside the modal
      $('#managers_key_modal').modal({
        backdrop: 'static',
        keyboard: false
      })
      // =================================================================
      $("#managers_key_modal").modal("show");
      $('#username').val('');
      $('#password').val('');
    }
  }

  function view_mkey_modal_sales_date_adjustment_js()
  {
    var info = $("#cashier_info").text().split('|');
    $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>view_mkey_modal_sales_date_adjustment_route',
        data: {'tr_no': info[0],
               'emp_id': info[1],
               'sscode': info[3]
        },
        dataType: 'json',
        success: function(data) {
          if(data == 'EMPTY')
          {
            // for not disapear on clicking outside the modal
            $('#managers_key_modal').modal({
              backdrop: 'static',
              keyboard: false
            })
            // =================================================================
            $("#managers_key_modal").modal("show");
            $('#username').val('');
            $('#password').val('');
          }
          else
          {
            Swal.fire('INVALID UPDATE', 'Please remit the cash first before update sales date.', 'error');
            return;
          }
        }
    });
  }

function view_mkey_modal_batch_backdate_js()
{
  // for not disapear on clicking outside the modal
  $('#batch_adjust_sales_date_modal').modal({
    backdrop: 'static',
    keyboard: false
  })
  // =================================================================
  $("#batch_adjust_sales_date_modal").modal("show");
  $('#username').val('');
  $('#password').val('');
}

function adjust_batch_sales_date_js()
{ 
  var title = '<span style="color: red;">WARNING!</span>';
  Swal.fire({
  title: title,
  text: 'Are you sure you want to approve his/her adjustment of sales date?',
  icon: 'warning',
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
      // ============================================================================================
      var info = $("#cashier_info").text();
      var new_date = $('#new_batch_date').val();
      // ============================================================================================
      $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>adjust_batch_sales_date_route',
        data: {'info': info,
               'new_date': new_date,
               'username': $("#batch_username").val(),
               'password': $("#batch_password").val()
        },
        dataType: 'json',
        success: function(data) {
          if(data=='EXPIRED SESSION')
          {
              Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
            
              setTimeout(function() {
                window.parent.location.href = "<?php echo base_url() ?>partial_remitted_cash_route";
              }, 1000);
          }
          else if(data == 'EMPTY')
          {
            Swal.fire('MISMATCH', 'Invalid username and password.', 'error')
          }
          else if(data == 'INVALID SUBORDINATES')
          {
            Swal.fire('INVALID SUBORDINATES', '', 'error')
          }
          else
          {
            $('#batch_adjust_sales_date_modal').modal('toggle');
            $('#batch_sales_date_adjustment_modal').modal('toggle');
            partial_remitted_cash_js();
            Swal.fire('ADJUSTED', '', 'success')
          }
        }
      });
    } else if (result.isDenied) {
      Swal.fire('CANCELLED', '', 'info')
    }
  })
}

  function adjust_zero_rs_js()
  { 
    var title = '<span style="color: red;">WARNING!</span>';
    Swal.fire({
    title: title,
    text: 'Are you sure you want to approve his/her adjustment of registered sales?',
    icon: 'warning',
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
        // ============================================================================================
        var info = $("#cashier_info").text().split('|');
        var registered_sales = $('#registered_sales').val().split(',').join('');
        var variance = $('#zero_rs_variance').val().split(',').join('');
        var variance_txt = $("#variance_txt").text().split(':').join('');
        var tr_count = $('#tr_count').val();
        // ============================================================================================
        $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>adjust_zero_rs_route',
          data: {'cs_data_id': info[0],
                 'cs_den_id': info[1],
                 'tr_no': info[2],
                 'emp_id': info[3],
                 'ccode': info[4],
                 'bcode': info[5],
                 'registered_sales': registered_sales,
                 'variance': variance,
                 'variance_txt': variance_txt,
                 'tr_count': tr_count,
                 'username': $("#username").val(),
                 'password': $("#password").val()
          },
          dataType: 'json',
          success: function(data) {
            if(data=='EXPIRED SESSION')
            {
                Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
              
                setTimeout(function() {
                  window.parent.location.href = "<?php echo base_url() ?>adjustment_cash_route";
                }, 1000);
            }
            else if(data == 'EMPTY')
            {
              Swal.fire('MISMATCH', 'Invalid username and password.', 'error')
            }
            else if(data == 'INVALID SUBORDINATES')
            {
              Swal.fire('INVALID SUBORDINATES', '', 'error')
            }
            else if(data == 'ALREADY ADJUSTED')
            {
              $('#managers_key_modal').modal('toggle');
              $('#zero_rs_adjustment_modal').modal('toggle');
              posted_zero_registered_sales_js();
              Swal.fire('ALREADY ADJUSTED', 'Already adjusted by another liquidation officer.', 'error')
            }
            else
            {
              $('#managers_key_modal').modal('toggle');
              $('#zero_rs_adjustment_modal').modal('toggle');
              posted_zero_registered_sales_js();
              Swal.fire('ADJUSTED', '', 'success')
              setTimeout(function() {
                print_submit_denominations_js(info[2],info[3],info[6],info[7],info[8],info[9]); 
              }, 1500);
            }
          }
        });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
  }

  function update_sales_date_js()
  { 
    var title = '<span style="color: red;">WARNING!</span>';
    Swal.fire({
    title: title,
    text: 'Are you sure you want to approve his/her adjustment of sales date?',
    icon: 'warning',
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
        // ============================================================================================
        var info = $("#cashier_info").text().split('|');
        var sales_date = $('#filter_date').val();
        // ============================================================================================
        $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>update_sales_date_route',
          data: {'tr_no': info[0],
                 'emp_id': info[1],
                 'dcode': info[2],
                 'sscode': info[3],
                 'sales_date': sales_date,
                 'username': $("#username").val(),
                 'password': $("#password").val()
          },
          dataType: 'json',
          success: function(data) {
            if(data=='EXPIRED SESSION')
            {
                Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
              
                setTimeout(function() {
                  window.parent.location.href = "<?php echo base_url() ?>adjustment_cash_route";
                }, 1000);
            }
            else if(data == 'EMPTY')
            {
              Swal.fire('MISMATCH', 'Invalid username and password.', 'error')
            }
            else if(data == 'INVALID SUBORDINATES')
            {
              Swal.fire('INVALID SUBORDINATES', '', 'error')
            }
            else
            {
              update_batch_counter_js(info[2]); 
              sales_date_adjustment_table_js(); 
              $('#sales_date_adjustment_modal').modal('toggle');
              $('#managers_key_modal').modal('toggle');
              Swal.fire('UPDATED', '', 'success');
            }
          }
        });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
  }

  function update_batch_counter_js(dcode)
  {
    $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>update_batch_counter_route',
        data: {'dcode': dcode},
        dataType: 'json',
        success: function(data) {
          
        }
    });
  }

  function get_year_js()
  {
    $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>get_year_route',
        dataType: 'json',
        success: function(data) {
            $("#year").html(data.html);
        }
    });
  }

  function view_productivity_js()
  {
    if($("#emp_name").val() == '')
    {
      Swal.fire('MISSING CASHIER', '', 'error');
    }
    else
    {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>view_productivity_route',
            data: {'emp_name': $("#emp_name").val(),
                  'dcode': $("#dept_name option:selected").val(),
                  'month': $("#month option:selected").val(),
                  'year': $("#year option:selected").text()
            },
            dataType: 'json',
            success: function(data) {
                if(data=='EXPIRED SESSION')
                {
                    Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                    setTimeout(function() {
                      window.parent.location.href = "<?php echo base_url() ?>productivity_report_route";
                    }, 1000);
                }
                else if(data.message == 'EMPTY')
                {
                    Swal.fire('INVALID NAME', 'Please input the correct name.', 'error');
                }
                else if(data.message == 'VALID NAME')
                {
                    Swal.fire('NO DATA', 'Please select another month or year.', 'error');
                    $("#cname").text('');
                    $("#cmonth").text('');
                    $("#cyear").text('');
                    $("#divbody_cashier_productivity").html('');
                }
                else
                {
                    $("#cname").text($("#emp_name").val());
                    $("#cmonth").text(' Of '+$("#month option:selected").text()+', ');
                    $("#cyear").text($("#year option:selected").text());
                    $("#divbody_cashier_productivity").html(data.html);
                }
            }
        });
    }
  }

  function auto_comma_number_js(id)
  {
    var num = $("#item_sold_id"+id).val();
    var commas = num.replace(/[^0-9]/g, "");
    commas = commas.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $("#item_sold_id"+id).val(commas);
    // =========================================================================
    var total_hrs = $("#total_hrs_id"+id).text();
    if(total_hrs != '0.00')
    {
      var item_sold =  $("#item_sold_id"+id).val().split(',').join('');
      var ave_item_sold =  item_sold / total_hrs;
      ave_item_sold =  ave_item_sold.toFixed(2);
      ave_item_sold = ave_item_sold.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      $("#ave_item_sold_hrs_id"+id).text(ave_item_sold);
    }
    // ==========================================================================
    var sum = 0;
    $(".item_sold").each(function() {
        //add only if the value is number
        var val = this.value.split(',').join('');
        if (!isNaN(val) && val.length != 0) {
            sum += parseFloat(val);
            // $(this).css("background-color", "#FEFFB0");
        }
        else if (val.length != 0){
            // $(this).css("background-color", "red");
        }
    });
    sum = sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $("#total_item_sold_id").text(sum);
    // ===================================================================================
    var footer_ave_item_sold_hour = 0;
    $(".ave_item_sold_hrs_id").each(function() {
        footer_ave_item_sold_hour += parseFloat($(this).text().split(',').join(''));
    });
    footer_ave_item_sold_hour = footer_ave_item_sold_hour.toFixed(2);
    footer_ave_item_sold_hour = footer_ave_item_sold_hour.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $("#total_ave_item_sold_hr_id").text(footer_ave_item_sold_hour);
  }

  function compute_hours_js(id)
  {
    var float_time = $("#float_time_id"+id).val();
    var reading_time = $("#reading_time_id"+id).val();
    var valuestart = moment.duration(float_time, "HH:mm");
    var valuestop = moment.duration(reading_time, "HH:mm");
    if(float_time != '' && reading_time != '')
    {
      var difference = valuestop.subtract(valuestart);
      if(difference.hours() < 0 || difference.minutes() < 0)
      {
        Swal.fire('INVALID TIME!', 'Float Time never greather than Reading Time.', 'error');
        // ===================================================================================
        var footer_minutes = $("#total_minute_id").text().split(',').join('');
        var minus_minutes = $("#minute_id"+id).text();
        footer_minutes = footer_minutes - minus_minutes;
        footer_minutes = footer_minutes.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $("#total_minute_id").text(footer_minutes);
        // ===================================================================================
        $("#no_of_hrs_id"+id).text('0:00');
        $("#hours_id"+id).text('0');
        $("#minute_id"+id).text('0');
        $("#total_hrs_id"+id).text('0.00');
        $("#ave_sales_hrs_id"+id).text('0.00');
        $("#ave_tr_count_hrs_id"+id).text('0.00');
        $("#ave_item_sold_hrs_id"+id).text('0.00');
        // ===================================================================================
        $("#float_time_id"+id).css("background-color", "red");
        $("#reading_time_id"+id).css("background-color", "red");
        $("#update_btn"+id).prop("hidden", true);
        // ===================================================================================
        var footer_hours = 0;
        $(".hours_id").each(function() {
            footer_hours += parseFloat($(this).text());
        });
        footer_hours = footer_hours.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $("#total_hour_id").text(footer_hours);
        // ===================================================================================
        var footer_minutes = 0;
        $(".minute_id").each(function() {
            footer_minutes += parseFloat($(this).text());
        });
        footer_minutes = footer_minutes.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $("#total_minute_id").text(footer_minutes);
        // ===================================================================================
        var footer_ave_sales_hour = 0;
        $(".ave_sales_hrs_id").each(function() {
            footer_ave_sales_hour += parseFloat($(this).text().split(',').join(''));
        });
        footer_ave_sales_hour = footer_ave_sales_hour.toFixed(2);
        footer_ave_sales_hour = footer_ave_sales_hour.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $("#total_ave_sales_hr_id").text(footer_ave_sales_hour);
        // ===================================================================================
        var footer_ave_tr_count_hour = 0;
        $(".ave_tr_count_hrs_id").each(function() {
            footer_ave_tr_count_hour += parseFloat($(this).text().split(',').join(''));
        });
        footer_ave_tr_count_hour = footer_ave_tr_count_hour.toFixed(2);
        footer_ave_tr_count_hour = footer_ave_tr_count_hour.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $("#total_ave_tr_count_hr_id").text(footer_ave_tr_count_hour);
        // ===================================================================================
        var footer_ave_item_sold_hour = 0;
        $(".ave_item_sold_hrs_id").each(function() {
            footer_ave_item_sold_hour += parseFloat($(this).text().split(',').join(''));
        });
        footer_ave_item_sold_hour = footer_ave_item_sold_hour.toFixed(2);
        footer_ave_item_sold_hour = footer_ave_item_sold_hour.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $("#total_ave_item_sold_hr_id").text(footer_ave_item_sold_hour);
      }
      else
      {
        var total_sales =  $("#total_sales_id"+id).text().split(',').join('');
        // ==============================================================================
        var hours = difference.hours();
        var minute = String(difference.minutes()).padStart(2, "0");
        var total_hrs = minute / 60 + 8;
        total_hrs = total_hrs.toFixed(2);
        // ===============================================================================
        var ave_sales = total_sales / total_hrs;
        ave_sales = ave_sales.toFixed(2);
        ave_sales = ave_sales.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        // ===============================================================================
        var tr_count =  $("#tr_count_id"+id).text();
        var ave_tr_count = tr_count / total_hrs;
        ave_tr_count = ave_tr_count.toFixed(2);
        // ===============================================================================
        var item_sold =  $("#item_sold_id"+id).val().split(',').join('');
        var ave_item_sold =  item_sold / total_hrs;
        ave_item_sold =  ave_item_sold.toFixed(2);
        ave_item_sold = ave_item_sold.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        // ===============================================================================

        $("#no_of_hrs_id"+id).text(hours + ":" + minute);
        $("#hours_id"+id).text(hours);
        $("#minute_id"+id).text(minute);
        $("#total_hrs_id"+id).text(total_hrs);
        $("#ave_sales_hrs_id"+id).text(ave_sales);
        $("#ave_tr_count_hrs_id"+id).text(ave_tr_count);
        $("#ave_item_sold_hrs_id"+id).text(ave_item_sold);
        // ===================================================================================
        $("#float_time_id"+id).css("background-color", "transparent");
        $("#reading_time_id"+id).css("background-color", "transparent");
        $("#update_btn"+id).prop("hidden", false);
        // ===================================================================================
        var footer_hours = 0;
        $(".hours_id").each(function() {
            footer_hours += parseFloat($(this).text());
        });
        footer_hours = footer_hours.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $("#total_hour_id").text(footer_hours);
        // ===================================================================================
        var footer_minutes = 0;
        $(".minute_id").each(function() {
            footer_minutes += parseFloat($(this).text());
        });
        footer_minutes = footer_minutes.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $("#total_minute_id").text(footer_minutes);
        // ===================================================================================
        var footer_ave_sales_hour = 0;
        $(".ave_sales_hrs_id").each(function() {
            footer_ave_sales_hour += parseFloat($(this).text().split(',').join(''));
        });
        footer_ave_sales_hour = footer_ave_sales_hour.toFixed(2);
        footer_ave_sales_hour = footer_ave_sales_hour.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $("#total_ave_sales_hr_id").text(footer_ave_sales_hour);
        // ===================================================================================
        var footer_ave_tr_count_hour = 0;
        $(".ave_tr_count_hrs_id").each(function() {
            footer_ave_tr_count_hour += parseFloat($(this).text().split(',').join(''));
        });
        footer_ave_tr_count_hour = footer_ave_tr_count_hour.toFixed(2);
        footer_ave_tr_count_hour = footer_ave_tr_count_hour.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $("#total_ave_tr_count_hr_id").text(footer_ave_tr_count_hour);
        // ===================================================================================
        var footer_ave_item_sold_hour = 0;
        $(".ave_item_sold_hrs_id").each(function() {
            footer_ave_item_sold_hour += parseFloat($(this).text().split(',').join(''));
        });
        footer_ave_item_sold_hour = footer_ave_item_sold_hour.toFixed(2);
        footer_ave_item_sold_hour = footer_ave_item_sold_hour.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $("#total_ave_item_sold_hr_id").text(footer_ave_item_sold_hour);
      }
    }
  }

  function save_productivivty_js()
  {
    Swal.fire({
    title: 'Are you sure you want to save cashier productivity?',
    icon: 'info',
    showDenyButton: true,
    /* showCancelButton: true,*/
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
    actions: 'my-actions',
    /*  cancelButton: 'order-1 right-gap',*/
    confirmButton: 'order-2',
    denyButton: 'order-3',
    }
    }).then((result) => {
      if (result.isConfirmed) 
      {  
          var max_id = $("#max_id").text();
          var row_data = [];
          for(let i=1; i<=max_id; i++)
          {
            $(".row_data_txt"+i).each(function() {
              row_data.push($(this).text());
            });
            // =======================================
            $(".row_data_val"+i).each(function() {
              row_data.push($(this).val());
            });
            row_data.push('|');
          }
          row_data = row_data.join('^');
          row_data = row_data.substr(0, row_data.length - 1);
          // =====================================================
          $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>save_productivivty_route',
              data: {'emp_id': $("#emp_id").text(),
                    'dcode': $("#dcode").text(),
                    'row_data': row_data
              },
              dataType: 'json',
              success: function(data) {
                if(data=='EXPIRED SESSION')
                {
                    Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                    setTimeout(function() {
                      window.parent.location.href = "<?php echo base_url() ?>productivity_report_route";
                    }, 1000);
                }
                else if(data.message == 'NO INSERTED')
                {
                  Swal.fire('NO DATA', 'Please input item sold, float time and reading time before save.', 'error');
                }
                else
                {
                  reload_view_productivity_js();
                  Swal.fire('SAVE', '', 'success');
                }
              }
          });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    });
  }

  function reload_view_productivity_js()
  {
    $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>view_productivity_route',
        data: {'emp_name': $("#hidden_name").text(),
              'dcode': $("#dcode").text(),
              'month': $("#hidden_month").text(),
              'year': $("#hidden_year").text()
        },
        dataType: 'json',
        success: function(data) {
            if(data=='EXPIRED SESSION')
            {
                Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                setTimeout(function() {
                  window.parent.location.href = "<?php echo base_url() ?>productivity_report_route";
                }, 1000);
            }
            else if(data.message == 'EMPTY')
            {
                Swal.fire('INVALID NAME', 'Please input the correct name.', 'error');
            }
            else if(data.message == 'VALID NAME')
            {
                Swal.fire('NO DATA', 'Please select another month or year.', 'error');
                $("#cname").text('');
                $("#cmonth").text('');
                $("#cyear").text('');
                $("#divbody_cashier_productivity").html('');
            }
            else
            {
                $("#cname").text($("#emp_name").val());
                $("#cmonth").text(' Of '+$("#month option:selected").text()+', ');
                $("#cyear").text($("#year option:selected").text());
                $("#divbody_cashier_productivity").html(data.html);
            }
        }
    });
  }

  function edit_productivity_js(id)
  {
    $("#item_sold_id"+id).prop('disabled', false);
    $("#float_time_id"+id).prop('disabled', false);
    $("#reading_time_id"+id).prop('disabled', false);
    // ==================================================
    $("#edit_btn"+id).prop('hidden', true);
    $("#update_btn"+id).prop('hidden', false);
  }

  function update_productivity_js(id,data_id)
  {
    Swal.fire({
    title: 'Are you sure you want to update cashier productivity?',
    icon: 'info',
    showDenyButton: true,
    /* showCancelButton: true,*/
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
    actions: 'my-actions',
    /*  cancelButton: 'order-1 right-gap',*/
    confirmButton: 'order-2',
    denyButton: 'order-3',
    }
    }).then((result) => {
      if (result.isConfirmed) 
      {  
          var item_sold = $("#item_sold_id"+id).val().split(',').join('');
          var float_time_id = $("#float_time_id"+id).val();
          var reading_time_id = $("#reading_time_id"+id).val();
          var no_of_hrs_id = $("#no_of_hrs_id"+id).text();
          var hours_id = $("#hours_id"+id).text();
          var minute_id = $("#minute_id"+id).text();
          var total_hrs_id = $("#total_hrs_id"+id).text();
          var ave_sales_hrs_id = $("#ave_sales_hrs_id"+id).text().split(',').join('');
          var ave_tr_count_hrs_id = $("#ave_tr_count_hrs_id"+id).text().split(',').join('');
          var ave_item_sold_hrs_id = $("#ave_item_sold_hrs_id"+id).text().split(',').join('');
          // ===========================================================================================
          if(item_sold == '')
          {
            Swal.fire('MISSING ITEM SOLD', 'Please input item sold before update.', 'error');
          }
          else if(item_sold < 1)
          {
            Swal.fire('INVALID ITEM SOLD', 'Item Sold not less than 1.', 'error');
          }
          else
          {
            $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>update_productivity_route',
                data: {'item_sold': item_sold,
                      'float_time_id': float_time_id,
                      'reading_time_id': reading_time_id,
                      'no_of_hrs_id': no_of_hrs_id,
                      'hours_id': hours_id,
                      'minute_id': minute_id,
                      'total_hrs_id': total_hrs_id,
                      'ave_sales_hrs_id': ave_sales_hrs_id,
                      'ave_tr_count_hrs_id': ave_tr_count_hrs_id,
                      'ave_item_sold_hrs_id': ave_item_sold_hrs_id,
                      'data_id': data_id
                },
                dataType: 'json',
                success: function(data) {
                  if(data=='EXPIRED SESSION')
                  {
                      Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                      setTimeout(function() {
                        window.parent.location.href = "<?php echo base_url() ?>productivity_report_route";
                      }, 1000);
                  }
                  else
                  {
                    reload_view_productivity_js();
                    Swal.fire('UPDATED', '', 'success');
                  }
                }
            });
          }
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    });
  }

  function print_cashier_productivivty_js(emp_name,emp_id,dcode,month,year)
  {
    window.io = {
      open: function(verb, url, data, target){
          var form = document.createElement("form");
          form.action = url;
          form.method = verb;
          form.target = target || "_self";
          if (data) {
              for (var key in data) {
                  var input = document.createElement("textarea");
                  input.name = key;
                  input.value = typeof data[key] === "object"
                      ? JSON.stringify(data[key])
                      : data[key];
                  form.appendChild(input);
              }

          }
          form.style.display = 'none';
          document.body.appendChild(form);
          form.submit();
          document.body.removeChild(form);
      }
    };
    
    io.open('POST', '<?php echo base_url('print_cashier_productivivty_route'); ?>', { emp_name: emp_name, emp_id: emp_id, dcode: dcode, month: month, year: year },'_blank');  
  }

  function print_all_cashier_productivivty_js()
  {
    window.io = {
      open: function(verb, url, data, target){
          var form = document.createElement("form");
          form.action = url;
          form.method = verb;
          form.target = target || "_self";
          if (data) {
              for (var key in data) {
                  var input = document.createElement("textarea");
                  input.name = key;
                  input.value = typeof data[key] === "object"
                      ? JSON.stringify(data[key])
                      : data[key];
                  form.appendChild(input);
              }

          }
          form.style.display = 'none';
          document.body.appendChild(form);
          form.submit();
          document.body.removeChild(form);
      }
    };

    var dcode = $("#dept_name option:selected").val();
    var dept_name = $("#dept_name option:selected").text();
    var month = $("#month option:selected").val();
    var year = $("#year option:selected").text();
    var type = $("#report_type option:selected").text();

    if(type == 'PER HOUR')
    {
      // Swal.fire('UNDER MAINTENANCE', '', 'info');
      io.open('POST', '<?php echo base_url('print_cashier_per_hour_productivivty_route'); ?>', { dcode: dcode, month: month, year: year, dept_name: dept_name },'_blank');  
    }
    else if(type == 'MONTHLY')
    {
      io.open('POST', '<?php echo base_url('print_cashier_monthly_productivivty_route'); ?>', { dcode: dcode, month: month, year: year, dept_name: dept_name },'_blank');  
    }
  }



</script>