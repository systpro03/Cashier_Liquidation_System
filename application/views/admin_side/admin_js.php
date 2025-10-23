<!-- swal alert -->
<script src="<?php echo base_url('assets/js/dataTables.fixedHeader.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2@11.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.min.js'); ?>"></script>


<script>


  function display_bunit_js() {
    $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>display_bunit_route',
      dataType: 'json',
      success: function (data) {
        $('#bunit_name').html(data.bunit_name);
      }
    });
  }

  function get_bunitcode_js() {
    console.log($('#bunit_name').val());
  }

  function search_emp_js() {
    var availableTags = [];

    $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>search_emp_route',
      data: { 'emp_name': $("#emp_name").val() },
      dataType: 'json',
      success: function (data) {
        if (data == 'EXPIRED SESSION') {
          Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')

          setTimeout(function () {
            window.parent.location.href = "<?php echo base_url() ?>adduser_access_route";
          }, 1000);
        }
        else {
          availableTags = data.emp_name.split('^');
          // console.log(availableTags);
          $("#emp_name").autocomplete({
            source: availableTags
          });
        }
      }
    });
  }

  function cancel_js() {
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
      if (result.isConfirmed) {
        Swal.fire('CANCELLED', '', 'info')

        setTimeout(function () {
          window.parent.location.href = "<?php echo base_url() ?>adduser_access_route";
        }, 1000);

      } else if (result.isDenied) {
        Swal.fire('CANCEL', '', 'info')
      }
    })
  }

  function addpayment_user_js() {
    Swal.fire({
      title: 'Are you sure you want to add?',
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

        // console.log($("#emp_name").val());
        $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>addpayment_user_route',
          data: { 'emp_name': $("#emp_name").val() },
          dataType: 'json',
          success: function (data) {
            if (data == 'EXPIRED SESSION') {
              Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')

              setTimeout(function () {
                window.parent.location.href = "<?php echo base_url() ?>adduser_access_route";
              }, 1000);
            }
            else if (data == 'INVALID EMPLOYEE') {
              Swal.fire('INVALID EMPLOYEE', 'Please select employee in search box', 'error')
            }
            else if (data == 'ALREADY EXIST') {
              Swal.fire('ALREADY EXIST', '', 'error')
            }
            else {
              Swal.fire('ADDED', '', 'success')

              setTimeout(function () {
                window.parent.location.href = "<?php echo base_url() ?>adduser_access_route";
              }, 1000);
            }
          }
        });

      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
  }

  function display_user_js() {
    $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>display_user_route',
      dataType: 'json',
      success: function (data) {
        console.log(data.html);
        $('#div_user_list').html(data.html);
        addpayment_user_datatable();
      }
    });
  }

  function addpayment_user_datatable() {
    /*sort datatable*/
    $(document).ready(function () {
      $('#addpayment_user_table').DataTable({
        // retrieve: true,
        "columnDefs":
          [
            { "className": "text-center", "targets": [0, 1] }
          ],
        "order": [
          [0, "asc"]
        ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
      });
    });

  }

  function delete_user_js(id, name) {
    Swal.fire({
      title: name,
      text: 'Are you sure you want to delete?',
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

        // console.log($("#emp_name").val());
        $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>delete_user_route',
          data: { 'id': id },
          dataType: 'json',
          success: function (data) {
            if (data == 'EXPIRED SESSION') {
              Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')

              setTimeout(function () {
                window.parent.location.href = "<?php echo base_url() ?>adduser_access_route";
              }, 1000);
            }
            else {
              Swal.fire('DELETED', '', 'success')

              setTimeout(function () {
                window.parent.location.href = "<?php echo base_url() ?>adduser_access_route";
              }, 1000);
            }
          }
        });

      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
  }

  function get_bunit_js() {
    $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>get_bunit_route',
      dataType: 'json',
      success: function (data) {
        $('#bunit_name').html(data.bunit_name);
        // display_payment_list_js();
      }
    });
  }

  function display_payment_list_js() {
    $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>display_payment_list_route',
      dataType: 'json',
      success: function (data) {
        $('#div_payment_list').html(data.html);
        paymentlist_datatable();
      }
    });
  }

  function all_bu_js() {
    $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>get_all_bu_route',
      dataType: 'json',
      success: function (data) {
        $("#bunit_name").html(data.bunit_name);
        get_dept_name_js();
      }
    });
  }




  function get_dept_name_js() {
    $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>get_admin_deptname_route',
      data: { 'bcode': $("#bunit_name").val() },
      dataType: 'json',
      success: function (data) {
        $("#dept_name").html(data.dept_name);

      }
    });
  }
  $('#bunit_name').change(function () {
    get_dept_name_js();
    get_cashier_transaction_js();
  });
  $('#dept_name').change(function () {
    get_cashier_transaction_js();
  });
  $('#filter_date').change(function () {
    get_cashier_transaction_js();
  });
  function get_cashier_transaction_js() {
    $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>get_cashier_transaction_route',
      data: {
        'dcode': $("#dept_name option:selected").val(),
        'date': $("#filter_date").val(),
        'dname': $("#dept_name option:selected").text()
      },
      dataType: 'json',
      beforeSend: function () {
        // Show loader while waiting
      $("#div_cashier_transaction_table").html(
        '<div class="text-center p-3">' +
          '<i class="glyphicon glyphicon-refresh spin" style="font-size:24px; color: rgba(255, 102, 0, 1);"></i>' +
          '<br><small>Loading transactions...</small>' +
        '</div>'
      );

      },
      success: function (data) {

        $("#div_cashier_transaction_table").html(data.html);

        if ($.fn.DataTable.isDataTable('#cashier_transaction_tbl')) {
          $('#cashier_transaction_tbl').DataTable().clear().destroy();
        }

        cashier_transaction_datatable();
      },
      error: function () {
        $("#div_cashier_transaction_table").html(
          '<div class="text-danger text-center p-3">⚠️ Failed to load transactions.</div>'
        );
      }
    });
  }

  function cashier_transaction_datatable() {
    $('#cashier_transaction_tbl').DataTable({
      columnDefs: [
        { className: "text-center", targets: [2, 3, 4] }
      ],
      order: [[0, "asc"]]
    });
  }


  function view_cash_den_js(id, tr_no, emp_id, location, date, emp_name, remit_type) {
    // for not disapear on clicking outside the modal
    $('#cash_den_modal').modal({
      backdrop: 'static',
      keyboard: false
    })
    // =================================================================
    $("#cash_den_modal").modal("show");
    $("#cashier_name").text(emp_name);
    $("#remittance_type").text(remit_type);
    $("#cashier_info").text(id + '|' + tr_no + '|' + emp_id + '|' + location + '|' + date + '|' + remit_type);
    //  ================================================================
    $("#cash_den_bodymodal").html('');
    $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>get_cash_den_route',
      data: {
        'id': id,
        'tr_no': tr_no,
        'emp_id': emp_id,
        'location': location,
        'date': date,
        'remit_type': remit_type
      },
      dataType: 'json',
      success: function (data) {
        $("#cash_den_bodymodal").html(data.html);
      }
    });
  }

  function calculate_cash_den_js() {

    var remittance_type = $("#remittance_type").text();
    // ==================================================
    var onek = $("#onek").val() * 1000;
    var fiveh = $("#fiveh").val() * 500;
    var twoh = $("#twoh").val() * 200;
    var oneh = $("#oneh").val() * 100;
    var fifty = $("#fifty").val() * 50;
    var twenty = $("#twenty").val() * 20;
    // ==================================================
    if (remittance_type == 'FINAL') {
      var ten = $("#ten").val() * 10;
      var five = $("#five").val() * 5;
      var one = $("#one").val() * 1;
      var twentyfive_cents = $("#twentyfive_cents").val() * 0.25;
      var ten_cents = $("#ten_cents").val() * 0.10;
      var five_cents = $("#five_cents").val() * 0.05;
      var one_cents = $("#one_cents").val() * 0.01;

      var new_cash = onek + fiveh + twoh + oneh + fifty + twenty + ten + five + one + twentyfive_cents + ten_cents + five_cents + one_cents;
      $("#new_cash").text(new_cash.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    }
    else {
      var new_cash = onek + fiveh + twoh + oneh + fifty + twenty;
      $("#new_cash").text(new_cash.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    }
  }



  function update_cash_den_js() {
    Swal.fire({
      title: 'Are you sure you want to update?',
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
        var cashier_data = $("#cashier_info").text().split('|');
        var onek = $("#onek").val();
        var fiveh = $("#fiveh").val();
        var twoh = $("#twoh").val();
        var oneh = $("#oneh").val();
        var fifty = $("#fifty").val();
        var twenty = $("#twenty").val();
        var ten = 0;
        var five = 0;
        var one = 0;
        var twentyfive_cents = 0;
        var ten_cents = 0;
        var five_cents = 0;
        var one_cents = 0;
        // ========================================================================
        if (cashier_data[5] == 'FINAL') {
          ten = $("#ten").val();
          five = $("#five").val();
          one = $("#one").val();
          twentyfive_cents = $("#twentyfive_cents").val();
          ten_cents = $("#ten_cents").val();
          five_cents = $("#five_cents").val();
          one_cents = $("#one_cents").val();
        }
        // ========================================================================
        // var new_cash = $("#new_cash").text().split(',').join('');
        // var old_cash = $("#old_cash").text().split(',').join('');
        // var difference = new_cash - old_cash;

        var new_cash = parseFloat($("#new_cash").text().replace(/,/g, ''));
        var old_cash = parseFloat($("#old_cash").text().replace(/,/g, ''));
        var difference = (parseFloat(new_cash) - parseFloat(old_cash)).toFixed(2);
        // ========================================================================

        console.log('New Cash:', new_cash);
        console.log('Old Cash:', old_cash);
        console.log('Difference:', difference);


        $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>update_cash_den_route',
          data: {
            'onek': onek,
            'fiveh': fiveh,
            'twoh': twoh,
            'oneh': oneh,
            'fifty': fifty,
            'twenty': twenty,
            'ten': ten,
            'five': five,
            'one': one,
            'twentyfive_cents': twentyfive_cents,
            'ten_cents': ten_cents,
            'five_cents': five_cents,
            'one_cents': one_cents,
            'new_cash': new_cash,
            'difference': difference,
            'id': cashier_data[0],
            'tr_no': cashier_data[1],
            'emp_id': cashier_data[2],
            'location': cashier_data[3],
            'date': cashier_data[4],
            'remit_type': cashier_data[5]
          },
          dataType: 'json',
          success: function (data) {
            if (data.message == 'success') {
              Swal.fire('UPDATED', '', 'success');
              $('#cash_den_modal').modal('hide');
            } else {
              Swal.fire('UPDATED', '', 'success');
              $('#cash_den_modal').modal('hide');
            }
          }
        });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info');
      }
    });
  }

  function view_noncash_den_js(tr_no, emp_id, location, date, emp_name) {
    // for not disapear on clicking outside the modal
    $('#noncash_den_modal').modal({
      backdrop: 'static',
      keyboard: false
    })
    // =================================================================
    $("#noncash_den_modal").modal("show");
    $("#noncash_cashier_name").text(emp_name);
    $("#noncash_cashier_info").text(tr_no + '|' + emp_id + '|' + location + '|' + date);
    //  ================================================================
    $("#mop_array").text('');
    $("#noncash_den_bodymodal").html('');
    $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>get_noncash_den_route',
      data: {
        'tr_no': tr_no,
        'emp_id': emp_id,
        'location': location,
        'date': date
      },
      dataType: 'json',
      success: function (data) {
        $("#mop_array").text(data.mop_array);
        $("#noncash_den_bodymodal").html(data.html);
      }
    });
  }


  function update_noncash_js_button(button_element) {

    let id = button_element.getAttribute('data-id');
    let old_amount = button_element.getAttribute('data-amount');
    let total_amount = button_element.getAttribute('data-total');

    Swal.fire({
      title: 'Are you sure you want to update?',
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
        var cashier_info = $("#noncash_cashier_info").text().split('|');
        var mop_name = $("#mop_name" + id + " option:selected").text();
        var noncash_qty = $("#noncash_qty" + id).val();
        // var new_noncash_amount = $("#noncash_amount"+id).val().split(',').join('');
        // var variance = new_noncash_amount - old_amount;
        var new_noncash_amount = $("#noncash_amount" + id).val().replace(/,/g, '');
        // var variance = (parseFloat(new_noncash_amount) - parseFloat(old_amount)).toFixed(2);
        var variance = new_noncash_amount - old_amount;


        console.log('New nonCash:', new_noncash_amount);
        console.log('Old nonCash:', old_amount);
        console.log('Variance:', variance);


        // ==================================================================================
        $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>update_noncash_route',
          data: {
            'id': id,
            'tr_no': cashier_info[0],
            'emp_id': cashier_info[1],
            'location': cashier_info[2],
            'date': cashier_info[3],
            'mop_name': mop_name,
            'noncash_qty': noncash_qty,
            'noncash_amount': new_noncash_amount,
            'variance': variance
          },
          dataType: 'json',
          success: function (data) {
            if (data.message == 'DUPLICATE') {

              Swal.fire('DUPLICATE MOP', 'Please check your mode of payment.', 'error');
            }
            else {
              // $('#noncash_den_modal').modal('hide');
              Swal.fire('UPDATED', '', 'success');
              // $('#old_amount').val(data.new_amount);
              button_element.setAttribute('data-amount', data.new_amount);

              let total = 0;
              $(".noncash_body_amount ").each(function () {
                let val = $(this).val().replace(/,/g, '');
                if (!isNaN(val) && val !== '') {
                  total += parseFloat(val);
                }
              });

              // Update the footer total_amount field
              $("#total_amount").val(formatNumberWithCommas(total));



            }
          }
        });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info');
      }
    });
  }

  function formatNumberWithCommas(number) {
    return number.toLocaleString('en-US', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    });
  }


  function delete_zero_noncash_js(id, mop_name, amount) {
    Swal.fire({
      title: 'Are you sure you want to delete?',
      text: 'MOP: ' + mop_name + ' | Amount: ' + amount,
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
          type: 'post',
          url: '<?php echo base_url(); ?>Admin_controller/delete_zero_noncash_route',
          data: {
            'id': id,
            'mop_name': mop_name,
            'amount': amount
          },
          dataType: 'json',
          success: function (data) {
            if (data.message == 'DELETED') {
              Swal.fire('DELETED', '', 'success');
              $('#noncash_den_modal').modal('hide');
            }
          },

        });
      }
    });
  }

  function update_noncash_js(id, old_amount) {

    Swal.fire({
      title: 'Are you sure you want to update?',
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
        var cashier_info = $("#noncash_cashier_info").text().split('|');
        var mop_name = $("#mop_name" + id + " option:selected").text();
        var noncash_qty = $("#noncash_qty" + id).val();
        // var new_noncash_amount = $("#noncash_amount"+id).val().split(',').join('');
        // var variance = new_noncash_amount - old_amount;
        var new_noncash_amount = $("#noncash_amount" + id).val().replace(/,/g, '');
        // var variance = (parseFloat(new_noncash_amount) - parseFloat(old_amount)).toFixed(2);
        var variance = new_noncash_amount - old_amount;

        console.log('New nonCash:', new_noncash_amount);
        console.log('Old nonCash:', old_amount);
        console.log('Variance:', variance);


        // ==================================================================================
        $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>update_noncash_route',
          data: {
            'id': id,
            'tr_no': cashier_info[0],
            'emp_id': cashier_info[1],
            'location': cashier_info[2],
            'date': cashier_info[3],
            'mop_name': mop_name,
            'noncash_qty': noncash_qty,
            'noncash_amount': new_noncash_amount,
            'variance': variance
          },
          dataType: 'json',
          success: function (data) {
            if (data.message == 'DUPLICATE') {

              Swal.fire('DUPLICATE MOP', 'Please check your mode of payment.', 'error');
            }
            else {
              // $('#noncash_den_modal').modal('hide');
              Swal.fire('UPDATED', '', 'success');
              // $('#old_amount').val(data.new_amount);

            }
          }
        });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info');
      }
    });
  }

  // function view_terminal_js(tr_no, emp_id, location, date, emp_name, pos_name) {
  //   $('#terminal_no_modal').modal({
  //     backdrop: 'static',
  //     keyboard: false
  //   })
  //   $("#terminal_no_modal").modal("show");
  //   $("#terminal_no_cashier_name").text(emp_name);
  //   $("#terminal_no_cashier_info").text(tr_no + '|' + emp_id + '|' + location + '|' + date + '|' + pos_name);
  //   $("#terminal_no").html('');
  //   $("#total_sales").text('');
  //   $("#registered_sales").val('');
  //   $("#old_registered_sales").text('');
  //   $("#discount").val('');
  //   $("#old_discount").text('');
  //   $("#tr_count").val('');
  //   $("#old_tr_count").text('');
  //   $.ajax({
  //     type: 'post',
  //     url: '<?php echo base_url(); ?>view_terminal_route',
  //     data: {
  //       'tr_no': tr_no,
  //       'emp_id': emp_id,
  //       'location': location,
  //       'date': date,
  //       'pos_name': pos_name
  //     },
  //     dataType: 'json',
  //     success: function (data) {
  //       $("#terminal_no").html(data.terminal);
  //       $("#total_sales").text(data.total_sales);
  //       $("#total_sales1").val(data.total_sales);
  //       $("#registered_sales").val(data.registered_sales);
  //       $("#old_registered_sales").text(data.registered_sales);
  //       $("#discount").val(data.discount);
  //       $("#old_discount").text(data.discount);
  //       $("#tr_count").val(data.tr_count);
  //       $("#old_tr_count").text(data.tr_count);
  //     }
  //   });
  // }

  function view_terminal_js(button_element) {

    let tr_no = button_element.getAttribute('data-trno');
    let emp_id = button_element.getAttribute('data-empid');
    let location = button_element.getAttribute('data-loc');
    let date = button_element.getAttribute('data-date');
    let emp_name = button_element.getAttribute('data-emp');
    let pos_name = button_element.getAttribute('data-pos');


    $('#terminal_no_modal').modal({
      backdrop: 'static',
      keyboard: false
    })
    // =================================================================
    $("#terminal_no_modal").modal("show");
    $("#terminal_no_cashier_name").text(emp_name);
    $("#terminal_no_cashier_info").text(tr_no + '|' + emp_id + '|' + location + '|' + date + '|' + pos_name);
    //  ================================================================
    $("#terminal_no").html('');
    $("#total_sales").text('');
    $("#registered_sales").val('');
    $("#short").val('');
    $("#old_registered_sales").text('');
    $("#discount").val('');
    $("#old_discount").text('');
    $("#tr_count").val('');
    $("#old_tr_count").text('');
    $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>view_terminal_route',
      data: {
        'tr_no': tr_no,
        'emp_id': emp_id,
        'location': location,
        'date': date,
        'pos_name': pos_name
      },
      dataType: 'json',
      success: function (data) {
        // let short = data.total_sales - data.registered_sales - data.discount;
        $("#terminal_no").html(data.terminal);
        $("#total_sales").text(data.total_sales);
        $("#total_sales1").val(data.total_sales);
        $("#registered_sales").val(data.registered_sales);
        $("#old_registered_sales").text(data.registered_sales);
        $("#short").val(data.short);
        $("#type").val(data.type);
        $("#discount").val(data.discount);
        $("#old_discount").text(data.discount);
        $("#tr_count").val(data.tr_count);
        $("#old_tr_count").text(data.tr_count);
      }
    });
  }

  function update_terminal_js() {

    $(".btn-warning").prop("disabled", true);


    Swal.fire({
      title: 'Are you sure you want to update?',
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
        var counter_no = $("#terminal_no option:selected").val();
        var terminal_no = $("#terminal_no option:selected").text();
        var registered_sales = $("#registered_sales").val().split(',').join('');
        var old_registered_sales = $("#old_registered_sales").text().split(',').join('');
        var discount = $("#discount").val().split(',').join('');
        var old_discount = $("#old_discount").text().split(',').join('');
        var tr_count = $("#tr_count").val();
        var old_tr_count = $("#old_tr_count").text();
        var cashier_info = $("#terminal_no_cashier_info").text().split('|');

        var new_total_sales = $("#total_sales1").val().split(',').join('');

        $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>update_terminal_route',
          data: {
            'counter_no': counter_no,
            'terminal_no': terminal_no,
            'registered_sales': registered_sales,
            'old_registered_sales': old_registered_sales,
            'discount': discount,
            'old_discount': old_discount,
            'tr_count': tr_count,
            'old_tr_count': old_tr_count,
            'tr_no': cashier_info[0],
            'emp_id': cashier_info[1],
            'location': cashier_info[2],
            'date': cashier_info[3],
            'new_total_sales': new_total_sales
          },
          dataType: 'json',
          success: function (data) {
            get_cashier_transaction_js();
            Swal.fire('UPDATED', '', 'success');
            $(".btn-warning").prop("disabled", false);

          }
        });
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info');
        $(".btn-warning").prop("disabled", false);
      }
    });
  }

  function transfer_noncash_js(id, mop_name, old_amount) {
    // for not disapear on clicking outside the modal
    $('#transfer_noncash_den_modal').modal({
      backdrop: 'static',
      keyboard: false
    });
    // =================================================================
    $("#transfer_noncash_den_modal").modal("show");
    $("#origin_mop").text(mop_name + ': ' + parseFloat(old_amount).toLocaleString());
    $("#mop_info").text(id + '|' + old_amount);
    $("#transfer_qty").val('');
    $("#transfer_amount").val('');
    var cashier_info = $("#noncash_cashier_info").text().split('|');
    var mop_array = $("#mop_array").text().split('|');
    // =================================================================
    $("#transfer_mop").html('');
    $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>transfer_noncash_route',
      data: {
        'location': cashier_info[2],
        'mop_array': mop_array
      },
      dataType: 'json',
      success: function (data) {
        $("#transfer_mop").html(data.html);
      }
    });
  }

  function validate_transfer_amount_js() {
    var mop_info = $("#mop_info").text().split('|');
    var transfer_amount = $("#transfer_amount").val().split(',').join('');
    // =======================================================================
    if (parseFloat(transfer_amount) > parseFloat(mop_info[1])) {
      Swal.fire('INVALID AMOUNT!', 'Transfer amount not greater than origin amount.', 'error');
      $("#transfer_amount").val('');
    }
  }

  function transfer_mop_js() {
    var transfer_mop = $("#transfer_mop option:selected").text();
    var transfer_qty = $("#transfer_qty").val();
    var transfer_amount = $("#transfer_amount").val().split(',').join('');
    var mop_info = $("#mop_info").text().split('|');
    var cashier_info = $("#noncash_cashier_info").text().split('|');
    // ======================================================================
    if (parseFloat(transfer_amount) == 0) {
      Swal.fire('INVALID TRANSFER!', 'Amount must not be empty.', 'error');
    }
    else if (parseFloat(transfer_qty) == 0 || transfer_qty == '') {
      Swal.fire('INVALID TRANSFER!', 'Quantity must not be empty.', 'error');
    }
    else {
      $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>transfer_mop_route',
        data: {
          'id': mop_info[0],
          'transfer_mop': transfer_mop,
          'transfer_qty': transfer_qty,
          'transfer_amount': transfer_amount
        },
        dataType: 'json',
        success: function (data) {
          reload_noncash_den_js(cashier_info[0], cashier_info[1], cashier_info[2], cashier_info[3]);
          Swal.fire('TRANSFERRED', '', 'success');
        }
      });
    }
  }

  function reload_noncash_den_js(tr_no, emp_id, location, date) {
    $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>get_noncash_den_route',
      data: {
        'tr_no': tr_no,
        'emp_id': emp_id,
        'location': location,
        'date': date
      },
      dataType: 'json',
      success: function (data) {
        $("#mop_array").text(data.mop_array);
        $("#noncash_den_bodymodal").html(data.html);
      }
    });
  }

  function view_sales_date_js(tr_no, emp_id, location, date) {
    // for not disapear on clicking outside the modal
    $('#sales_date_modal').modal({
      backdrop: 'static',
      keyboard: false
    });
    // =================================================================
    $("#sales_date_modal").modal("show");
    $("#sales_date_info").text(tr_no + '|' + emp_id + '|' + location + '|' + date);
    $("#sales_date_header").text(date);
    $("#sales_date").val(date);
  }

  function update_sales_date_js() {
    Swal.fire({
      title: 'Are you sure you want to update?',
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
        var cashier_info = $("#sales_date_info").text().split('|');
        var old_sales_date = $("#sales_date_header").text();
        var new_sales_date = $("#sales_date").val();
        if (new_sales_date == old_sales_date) {
          Swal.fire('INVALID DATE!', 'Please select another date.', 'error');
        }
        else {
          $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>admin_update_sales_date_route',
            data: {
              'tr_no': cashier_info[0],
              'emp_id': cashier_info[1],
              'location': cashier_info[2],
              'old_sales_date': old_sales_date,
              'new_sales_date': new_sales_date
            },
            dataType: 'json',
            success: function (data) {
              get_cashier_transaction_js();
              Swal.fire('UPDATED', '', 'success');
            }
          });
        }
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info');
      }
    });
  }

  function view_location_js(tr_no, emp_id, location, date, borrowed) {
    // for not disapear on clicking outside the modal
    $('#location_modal').modal({
      backdrop: 'static',
      keyboard: false
    });
    // =================================================================
    if (borrowed == 'YES') {
      $("#borrowed_yes").prop('selected', true);
    } else if (borrowed == 'NO') {
      $("#borrowed_no").prop('selected', true);
    }
    // =================================================================
    $("#location_modal").modal("show");
    $("#location_info").text(tr_no + '|' + emp_id + '|' + location + '|' + date + '|' + borrowed);
    // =================================================================
    $("#location_header").text('');
    $("#department").html('');
    $("#section").html('');
    $("#sub_section").html('');
    $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>view_location_route',
      data: {
        'location': location,
        'borrowed': borrowed
      },
      dataType: 'json',
      success: function (data) {
        $("#location_header").text(data.location_name);
        $("#department").html(data.dept_name);
        $("#section").html(data.section_name);
        $("#sub_section").html(data.sub_section_name);
      }
    });
  }

  function get_section_js() {
    var dcode = $("#department option:selected").val();
    // =================================================
    if (dcode != null) {
      $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>admin_get_section_route',
        data: { 'dcode': dcode },
        dataType: 'json',
        success: function (data) {
          $("#section").html(data.section_html);
          get_sub_section_js();
        }
      });
    }
  }

  function get_sub_section_js() {
    var scode = $("#section option:selected").val();
    // ================================================
    if (scode != null) {
      $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>admin_get_sub_section_route',
        data: { scode: scode },
        dataType: 'json',
        success: function (data) {
          $("#sub_section").html(data.sub_section_html);
        }
      });
    } else {
      $("#sub_section").html('');
    }
  }

  function update_location_js() {
    Swal.fire({
      title: 'Are you sure you want to update?',
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
        var cashier_info = $("#location_info").text().split('|');
        var dcode = $("#department option:selected").val();
        var scode = $("#section option:selected").val();
        var sscode = $("#sub_section option:selected").val();
        var borrowed = $("#borrowed option:selected").text();
        // ========================================================
        var location = '';
        if (sscode != null) {
          location = sscode;
        } else if (scode != null) {
          location = scode;
        } else if (dcode != null) {
          location = dcode;
        }
        // ========================================================
        if (location == cashier_info[2] && borrowed == cashier_info[4]) {
          Swal.fire('INVALID LOCATION!', 'Please select another location.', 'error');
        } else {
          $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>update_location_route',
            data: {
              'tr_no': cashier_info[0],
              'emp_id': cashier_info[1],
              'date': cashier_info[3],
              'location': location,
              'borrowed': borrowed
            },
            dataType: 'json',
            success: function (data) {
              if (data.message == 'invalid') {
                Swal.fire('INVALID LOCATION!', 'You cannot borrow your current location.', 'error');
              } else {
                get_cashier_transaction_js();
                Swal.fire('UPDATED', '', 'success');
              }
            }
          });
        }
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info');
      }
    });
  }

  function view_batch_remittance_js(id, tr_no, emp_id, location, emp_name) {
    // for not disapear on clicking outside the modal
    $('#batch_remittance_modal').modal({
      backdrop: 'static',
      keyboard: false
    });
    // =================================================================
    $("#batch_remittance_modal").modal("show");
    $("#batch_remittance_info").text(id + '|' + tr_no + '|' + emp_id + '|' + location);
    $("#cashier_name_header").text(emp_name);
    // =================================================================
    $("#batch_remittance_bodymodal").html('');
    $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>view_batch_remittance_route',
      data: {
        'id': id,
        'tr_no': tr_no,
        'emp_id': emp_id,
        'location': location
      },
      dataType: 'json',
      success: function (data) {
        $("#batch_remittance_bodymodal").html(data.remittance_html);
      }
    });
  }

  function update_batch_remittance_js(id, batch, date, dcode) {
    Swal.fire({
      title: 'Are you sure you want to update?',
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
        var new_batch = $("#batch_no_remittance").val();
        var new_date = $("#date_remitted").val();
        if (new_batch == batch && new_date == date) {
          Swal.fire('INVALID', 'Please change the batch or date before you update.', 'error');
        } else if (new_batch < 1) {
          Swal.fire('INVALID BATCH', 'Batch not less than 1 or empty.', 'error');
        } else {
          $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>update_batch_remittance_route',
            data: {
              'id': id,
              'batch': new_batch,
              'date': new_date,
              'dcode': dcode
            },
            dataType: 'json',
            success: function (data) {
              get_cashier_transaction_js();
              Swal.fire('UPDATED', '', 'success');
            }
          });
        }
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info');
      }
    });
  }




</script>

<!-- <script>
                    
                        $("#onek").keydown(function(event) {
                            if (event.key === "e" || event.key === "E" || event.key === "+" || event.key === "-" || event.key === ".") {
                            event.preventDefault();
                            }
                        });
                        $("#fiveh").keydown(function(event) {
                            if (event.key === "e" || event.key === "E" || event.key === "+" || event.key === "-" || event.key === ".") {
                            event.preventDefault();
                            }
                        });
                        $("#twoh").keydown(function(event) {
                            if (event.key === "e" || event.key === "E" || event.key === "+" || event.key === "-" || event.key === ".") {
                            event.preventDefault();
                            }
                        });
                        $("#oneh").keydown(function(event) {
                            if (event.key === "e" || event.key === "E" || event.key === "+" || event.key === "-" || event.key === ".") {
                            event.preventDefault();
                            }
                        });
                        $("#fifty").keydown(function(event) {
                            if (event.key === "e" || event.key === "E" || event.key === "+" || event.key === "-" || event.key === ".") {
                            event.preventDefault();
                            }
                        });
                        $("#twenty").keydown(function(event) {
                            if (event.key === "e" || event.key === "E" || event.key === "+" || event.key === "-" || event.key === ".") {
                            event.preventDefault();
                            }
                        });
                        $("#ten").keydown(function(event) {
                            if (event.key === "e" || event.key === "E" || event.key === "+" || event.key === "-" || event.key === ".") {
                            event.preventDefault();
                            }
                        });
                        $("#five").keydown(function(event) {
                            if (event.key === "e" || event.key === "E" || event.key === "+" || event.key === "-" || event.key === ".") {
                            event.preventDefault();
                            }
                        });
                        $("#one").keydown(function(event) {
                            if (event.key === "e" || event.key === "E" || event.key === "+" || event.key === "-" || event.key === ".") {
                            event.preventDefault();
                            }
                        });
                        $("#twentyfive_cents").keydown(function(event) {
                            if (event.key === "e" || event.key === "E" || event.key === "+" || event.key === "-" || event.key === ".") {
                            event.preventDefault();
                            }
                        });
                        $("#ten_cents").keydown(function(event) {
                            if (event.key === "e" || event.key === "E" || event.key === "+" || event.key === "-" || event.key === ".") {
                            event.preventDefault();
                            }
                        });
                        $("#five_cents").keydown(function(event) {
                            if (event.key === "e" || event.key === "E" || event.key === "+" || event.key === "-" || event.key === ".") {
                            event.preventDefault();
                            }
                        });
                        $("#one_cents").keydown(function(event) {
                            if (event.key === "e" || event.key === "E" || event.key === "+" || event.key === "-" || event.key === ".") {
                            event.preventDefault();
                            }
                        });
  
                    </script> -->

                    <style>
                      .spin {
                        display: inline-block;
                        animation: spin 1s infinite linear;
                      }

                      @keyframes spin {
                        100% { transform: rotate(360deg); }
                      }

                    </style>