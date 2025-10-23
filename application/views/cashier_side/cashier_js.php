<!-- swal alert -->
<!-- <script src="<?php echo base_url('assets/js/dataTables.fixedHeader.min.js'); ?>"></script> -->
<script src="<?php echo base_url('assets/js/sweetalert2@11.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.min.js'); ?>"></script>


<script>

  function disabled_btnsave()
  {
    var tot_cash = $('#total_cash').val();
    var tot_cash = $('#total_noncash').val();

    if(tot_cash =='')
    {
      document.getElementById("btn_save_cashform").disabled = true;
    }
    else
    {
     document.getElementById("btn_save_cashform").disabled = false;
   }
 }

 function reset_cashform() {

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
    if (result.isConfirmed) {

      document.getElementById('q_onek').value = "";
      document.getElementById('q_fiveh').value = "";
      document.getElementById('q_twoh').value = "";
      document.getElementById('q_oneh').value = "";
      document.getElementById('q_fifty').value = "";
      document.getElementById('q_twenty').value = "";
      document.getElementById('q_ten').value = "";
      document.getElementById('q_five').value = "";
      document.getElementById('q_one').value = "";
      document.getElementById('q_twentyfivecents').value = "";
      document.getElementById('q_tencents').value = "";
      document.getElementById('q_fivecents').value = "";
      document.getElementById('q_onecents').value = "";
      calculate_breakdown_js();
      document.getElementById('total_cash').value = "";

    } else if (result.isDenied) {
      Swal.fire('Cancel reset', '', 'info')
    }
  })
}

function reset_noncashform() {

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

      window.parent.location.href = "<?php echo base_url() ?>cashier_noncashform_route"; 
   
    } else if (result.isDenied) {
      Swal.fire('Cancel reset', '', 'info')
    }
  })
}

function calculate_breakdown_js() {
  var res = $('#q_onek').val() * 1000;
  var res1 = $('#q_fiveh').val() * 500;
  var res2 = $('#q_twoh').val() * 200;
  var res3 = $('#q_oneh').val() * 100;
  var res4 = $('#q_fifty').val() * 50;
  var res5 = $('#q_twenty').val() * 20;
  var res6 = $('#q_ten').val() * 10;
  var res7 = $('#q_five').val() * 5;
  var res8 = $('#q_one').val() * 1;
  var res9 = $('#q_twentyfivecents').val() * 0.25;
  var res10 = $('#q_tencents').val() * 0.10;
  var res11 = $('#q_fivecents').val() * 0.05;
  var res12 = $('#q_onecents').val() * 0.01;
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

    $('#a_onek').val(amount.toLocaleString());
    $('#a_fiveh').val(amount1.toLocaleString());
    $('#a_twoh').val(amount2.toLocaleString());
    $('#a_oneh').val(amount3.toLocaleString());
    $('#a_fifty').val(amount4.toLocaleString());
    $('#a_twenty').val(amount5.toLocaleString());
    $('#a_ten').val(amount6.toLocaleString());
    $('#a_five').val(amount7.toLocaleString());
    $('#a_one').val(amount8.toLocaleString());
    $('#a_twentyfivecents').val(amount9.toLocaleString());
    $('#a_tencents').val(amount10.toLocaleString());
    $('#a_fivecents').val(amount11.toLocaleString());
    $('#a_onecents').val(amount12.toLocaleString());

    //   ====================TOTAL=====================================
    $('#total_cash').val(amount13.toLocaleString());
    $('#historytotal_cash').val(amount13.toLocaleString());

    /*=======================GRAND TOTAL================================*/
    var partial = $('#ch_partial').val();
    var partial2 = partial.split(',').join('');
    var gtotal = parseFloat(amount13) + parseFloat(partial2);
    $('#gtotal_cash').val(gtotal.toLocaleString());

  }

  function save_cash_denomination(trno) 
  {
    Swal.fire({
      title: 'Are you sure you want to submit?',
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
  
        setTimeout(function() {
          var currentdate = new Date();
          var datetime = currentdate.getFullYear() + "-" +
          (currentdate.getMonth() + 1) + "-" +
          currentdate.getDate() + " " +
          currentdate.getHours() + ":" +
          currentdate.getMinutes() + ":" +
          currentdate.getSeconds();

          var tot = $('#total_cash').val();
          var tot2 = tot.split(',').join('');
          var tr_no = ('0000000000' + trno).slice(-10);

          if(tot == '' || tot == '0')
          {
            Swal.fire('Missing Data', 'Total must not be empty or 0!', 'error')
          } 
          else
          {
              if($("#borrow_checkbox").is(':checked')){
                  $.ajax({
                  type: 'post',
                  url: '<?php echo base_url(); ?>save_cashdenomination_borrowed_route',
                  data: {
                    'tr_no': tr_no,
                    'onek': $('#q_onek').val(),
                    'fiveh': $('#q_fiveh').val(),
                    'twoh': $('#q_twoh').val(),
                    'oneh': $('#q_oneh').val(),
                    'fifty': $('#q_fifty').val(),
                    'twenty': $('#q_twenty').val(),
                    'ten': $('#q_ten').val(),
                    'five': $('#q_five').val(),
                    'one': $('#q_one').val(),
                    'twentyfivecents': $('#q_twentyfivecents').val(),
                    'tencents': $('#q_tencents').val(),
                    'fivecents': $('#q_fivecents').val(),
                    'onecents': $('#q_onecents').val(),
                    'total_cash': tot2,
                    'remit_type': $('#checkbox_cashremit').val(),
                    'status': 'PENDING',
                    'date': datetime,
                    'cash_section': $('#cash_section').val(),
                    'cash_subsection': $('#cash_subsection').val(),
                    'pos_name': $('#pos_name option:selected').text(),
                    'counter_no': $('#pos_name option:selected').val()
                  },
                  dataType: 'json',
                  success: function(data) {
                    if(data=='EXPIRED SESSION')
                    {
                      Swal.fire('EXPIRED SESSION', '', 'error')
                    
                      setTimeout(function() {
                        window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                        }, 1000);
                    }
                    else if(data=='INVALID')
                    {
                      Swal.fire('INVALID BORROWED', 'You selected your default department, please select another section or sub section', 'error')
                      return;
                    }
                    else if(data=='DUPLICATE')
                    {
                      Swal.fire('ALREADY EXIST!', '', 'error');
                    
                      setTimeout(function() {
                        window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                        }, 1000);
                    }
                    else
                    {
                        Swal.fire('SUBMITTED', '', 'success')    
                    
                        setTimeout(function() {
                          $('#cash_confirmationmodal').modal('toggle');
                          window.parent.location.href = "<?php echo base_url() ?>cashier_cashform_route";
                        }, 1000);
                    }
                  }
                });
              } else {
                  $.ajax({
                  type: 'post',
                  url: '<?php echo base_url(); ?>save_cashdenomination_route',
                  data: {
                    'tr_no': tr_no,
                    'onek': $('#q_onek').val(),
                    'fiveh': $('#q_fiveh').val(),
                    'twoh': $('#q_twoh').val(),
                    'oneh': $('#q_oneh').val(),
                    'fifty': $('#q_fifty').val(),
                    'twenty': $('#q_twenty').val(),
                    'ten': $('#q_ten').val(),
                    'five': $('#q_five').val(),
                    'one': $('#q_one').val(),
                    'twentyfivecents': $('#q_twentyfivecents').val(),
                    'tencents': $('#q_tencents').val(),
                    'fivecents': $('#q_fivecents').val(),
                    'onecents': $('#q_onecents').val(),
                    'total_cash': tot2,
                    'remit_type': $('#checkbox_cashremit').val(),
                    'status': 'PENDING',
                    'date': datetime,
                    'pos_name': $('#pos_name option:selected').text(),
                    'counter_no': $('#pos_name option:selected').val()
                  },
                  dataType: 'json',
                  success: function(data) {
                    if(data=='EXPIRED SESSION')
                    {
                      Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                    
                      setTimeout(function() {
                        window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                        }, 1000);
                    }
                    else if(data=='DUPLICATE')
                    {
                      Swal.fire('ALREADY EXIST!', '', 'error');
                    
                      setTimeout(function() {
                        window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                        }, 1000);
                    }
                    else
                    {
                        Swal.fire('SUBMITTED', '', 'success')    
                    
                        setTimeout(function() {
                          $('#cash_confirmationmodal').modal('toggle');
                          window.parent.location.href = "<?php echo base_url() ?>cashier_cashform_route";
                        }, 1000);
                    }
                  }
                });
              }
          }
        }, 500);
        
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
  }

  function update_historycashform_js()
  {
    if($('#pos_name option:selected').text() == 'Select POS')
    {
        Swal.fire('MISSING POS', 'Please select POS before update', 'error') 
        return;
    }
    else
    {
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
          if (result.isConfirmed) 
          {
            var tot = $('#historytotal_cash').val();
            var tot2 = tot.split(',').join('');
            var pos_name = $('#pos_name option:selected').text();
            var counter_no = $('#counter_no').text();
            if(pos_name == '')
            {
              pos_name = $('#pos_name2').val();
              counter_no = $('#counter_no2').val();
            }
            
            if(tot == '' || tot == '0')
            {
                Swal.fire('Missing Data', 'Total must not be empty or 0!', 'error')
            } 
            else
            {
                if($("#cash_borrow_checkbox").is(':checked')){
                    $.ajax({
                    type: 'post',
                    url: '<?php echo base_url(); ?>update_historycashform_borrowed_route',
                    data: {
                      'id': $('#history_cashform_id').val(),
                      'onek': $('#q_onek').val(),
                      'fiveh': $('#q_fiveh').val(),
                      'twoh': $('#q_twoh').val(),
                      'oneh': $('#q_oneh').val(),
                      'fifty': $('#q_fifty').val(),
                      'twenty': $('#q_twenty').val(),
                      'ten': $('#q_ten').val(),
                      'five': $('#q_five').val(),
                      'one': $('#q_one').val(),
                      'twentyfivecents': $('#q_twentyfivecents').val(),
                      'tencents': $('#q_tencents').val(),
                      'fivecents': $('#q_fivecents').val(),
                      'onecents': $('#q_onecents').val(),
                      'total_cash': tot2,
                      'cash_section': $('#cash_section').val(),
                      'cash_subsection': $('#cash_subsection').val(),
                      'pos_name': pos_name,
                      'counter_no': counter_no  
                    },
                    dataType: 'json',
                    success: function(data) {
                      console.log(data);

                      if(data=='EXPIRED SESSION')
                      {
                        Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                      
                        setTimeout(function() {
                          window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                          }, 1000);
                      }
                      else
                      {
                        Swal.fire('UPDATED', '', 'success');

                        setTimeout(function() {
                          window.parent.location.href = "<?php echo base_url() ?>cashier_historyform_route"; 
                        }, 1000);
                      }
                    
                    }
                  });
                } else {
                    $.ajax({
                    type: 'post',
                    url: '<?php echo base_url(); ?>update_historycashform_route',
                    data: {
                      'id': $('#history_cashform_id').val(),
                      'onek': $('#q_onek').val(),
                      'fiveh': $('#q_fiveh').val(),
                      'twoh': $('#q_twoh').val(),
                      'oneh': $('#q_oneh').val(),
                      'fifty': $('#q_fifty').val(),
                      'twenty': $('#q_twenty').val(),
                      'ten': $('#q_ten').val(),
                      'five': $('#q_five').val(),
                      'one': $('#q_one').val(),
                      'twentyfivecents': $('#q_twentyfivecents').val(),
                      'tencents': $('#q_tencents').val(),
                      'fivecents': $('#q_fivecents').val(),
                      'onecents': $('#q_onecents').val(),
                      'total_cash': tot2,
                      'pos_name': pos_name,
                      'counter_no': counter_no
                    },
                    dataType: 'json',
                    success: function(data) {
                      console.log(data);

                      if(data=='EXPIRED SESSION')
                      {
                        Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                      
                        setTimeout(function() {
                          window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                          }, 1000);
                      }
                      else
                      {
                        Swal.fire('UPDATED', '', 'success');

                        setTimeout(function() {
                          window.parent.location.href = "<?php echo base_url() ?>cashier_historyform_route"; 
                        }, 1000);
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

  function update_historycashform_js_v2()
  {
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
      if (result.isConfirmed) 
      {
        var tot = $('#historytotal_cash').val();
        var tot2 = tot.split(',').join('');
        if(tot == '' || tot == '0')
        {
            Swal.fire('Missing Data', 'Total must not be empty or 0!', 'error')
        } 
        else
        {
            $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>update_historycashform_route_v2',
              data: {
                'id': $('#history_cashform_id').val(),
                'onek': $('#q_onek').val(),
                'fiveh': $('#q_fiveh').val(),
                'twoh': $('#q_twoh').val(),
                'oneh': $('#q_oneh').val(),
                'fifty': $('#q_fifty').val(),
                'twenty': $('#q_twenty').val(),
                'ten': $('#q_ten').val(),
                'five': $('#q_five').val(),
                'one': $('#q_one').val(),
                'twentyfivecents': $('#q_twentyfivecents').val(),
                'tencents': $('#q_tencents').val(),
                'fivecents': $('#q_fivecents').val(),
                'onecents': $('#q_onecents').val(),
                'total_cash': tot2
              },
              dataType: 'json',
              success: function(data) {
                if(data=='EXPIRED SESSION')
                {
                  Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                
                  setTimeout(function() {
                    window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                    }, 1000);
                }
                else
                {
                  Swal.fire('UPDATED', '', 'success');
                  setTimeout(function() {
                    window.parent.location.href = "<?php echo base_url() ?>cashier_historyform_route"; 
                  }, 1000);
                }
              }
            })
        } 
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
  }

 function disabled_editbtn()
  {
      $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>disabled_saveresetbtn_route',
              dataType: 'json',
              success: function(data) 
              {
                 // console.log(data);
               if(data == 'PENDING') 
               {
                   // console.log('naay pending');
                  /*======================disabled button===========================*/
                   document.getElementById("btn_edit_cashform").disabled = false;
               }
               else
               {
                   // console.log('walay pending');
                  /*======================disabled button===========================*/
                   document.getElementById("btn_edit_cashform").disabled = true;
               }

              }
            });
  }

  function displayhistory_cashform_js() 
  {
    $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>displayhistory_cashform_route',
            dataType: 'json',
            success: function(data) {
              enabled_cash_updatecancel_js(data.cashremit_type,data.edit_remittance_type,data.edit_den_status,data.sname,data.ssname,data.pos_name,data.counter_no);
              $('#cashremit_type').html(data.cashremit_type+'&nbsp;&nbsp;REMITTANCE'); // dapat mao ni mauna ug load kaysa data.html para mo display ang remit type sa cash form
              $('#history_cashform_tbody').html(data.html);
            }
          });
  }
  function enabled_cash_updatecancel_js(remit_type,edit_remittance_type,edit_den_status,sname,ssname,pos_name,counter_no)
  {
    setTimeout(function() {
      if(sname != '')
      {
        $('#cash_borrow_checkbox').prop('checked', true);
        $('#cash_section_form2').prop('hidden', false);
        $('#cash_section2').val(sname);
        $('#cash_subsection2').val(ssname);
        $('#pos_name2').val(pos_name);
        $('#counter_no2').val(counter_no);
      } 
      // =================================================================
      if(remit_type == 'PARTIAL')
      {
        $('#partial_checkbox').prop('disabled', true);
      }
      else
      {
        $('#final_checkbox').prop('disabled', true);
      }
      // =================================================================
      if(edit_remittance_type == 'ENABLED')
      {
        $('#remittance_type').prop('hidden', false);
      }
      // =================================================================
      if(edit_den_status == 'ENABLED')
      {
        $('#btn_cancel_cashform').prop('disabled', false);
        $('#btn_update_cashform').prop('disabled', false);
      }
    }, 1000);
  }

  function disabled_cash_quantity_js()
  {
      document.getElementById("q_onek").disabled = true;
      document.getElementById("q_fiveh").disabled = true;
      document.getElementById("q_twoh").disabled = true;
      document.getElementById("q_oneh").disabled = true;
      document.getElementById("q_fifty").disabled = true;
      document.getElementById("q_twenty").disabled = true;
      document.getElementById("q_ten").disabled = true;
      document.getElementById("q_five").disabled = true;
      document.getElementById("q_one").disabled = true;
      document.getElementById("q_twentyfivecents").disabled = true;
      document.getElementById("q_tencents").disabled = true;
      document.getElementById("q_fivecents").disabled = true;
      document.getElementById("q_onecents").disabled = true;
  }

  function enabled_cash_quantity_js()
  {
      document.getElementById("q_onek").disabled = false;
      document.getElementById("q_fiveh").disabled = false;
      document.getElementById("q_twoh").disabled = false;
      document.getElementById("q_oneh").disabled = false;
      document.getElementById("q_fifty").disabled = false;
      document.getElementById("q_twenty").disabled = false;
      document.getElementById("q_ten").disabled = false;
      document.getElementById("q_five").disabled = false;
      document.getElementById("q_one").disabled = false;
      document.getElementById("q_twentyfivecents").disabled = false;
      document.getElementById("q_tencents").disabled = false;
      document.getElementById("q_fivecents").disabled = false;
      document.getElementById("q_onecents").disabled = false;
      document.getElementById("btn_edit_cashform").disabled = true;
      document.getElementById("btn_update_cashform").disabled = false;
      document.getElementById("btn_cancel_cashform").disabled = false;
      document.getElementById("borrow_checkbox").disabled = false;
  }

  function history_enabled_cash_quantity_js()
  {
      document.getElementById("q_onek").disabled = false;
      document.getElementById("q_fiveh").disabled = false;
      document.getElementById("q_twoh").disabled = false;
      document.getElementById("q_oneh").disabled = false;
      document.getElementById("q_fifty").disabled = false;
      document.getElementById("q_twenty").disabled = false;
      document.getElementById("q_ten").disabled = false;
      document.getElementById("q_five").disabled = false;
      document.getElementById("q_one").disabled = false;
      document.getElementById("q_twentyfivecents").disabled = false;
      document.getElementById("q_tencents").disabled = false;
      document.getElementById("q_fivecents").disabled = false;
      document.getElementById("q_onecents").disabled = false;
      document.getElementById("btn_edit_cashform").disabled = true;
      document.getElementById("btn_update_cashform").disabled = false;
      document.getElementById("btn_cancel_cashform").disabled = false;
      document.getElementById("cash_borrow_checkbox").disabled = false;
  }

  function canceledit_cash_denomination()
  {
        window.parent.location.href = "<?php echo base_url() ?>cashier_historyform_route"; 
  }

  function total_noncash_js()
  {

    var amount_Arr = [];
    document.querySelectorAll(".d_amount").forEach(function(el)
    {
      amount_Arr.push(el.value);
    });
    //console.log(amount_Arr);

    var total_amount = 0;
    for(var a=0;a<amount_Arr.length;a++)
    {
      var amount = amount_Arr[a].split(",").join("");
      total_amount += parseFloat(amount);
      
    }

     $("#total_noncash").val(total_amount.toLocaleString());
  
  }

  function total_hnoncash_js()
  {

    var amount_Arr = [];
    document.querySelectorAll(".hd_amount").forEach(function(el)
    {
      amount_Arr.push(el.value);
    });
    //console.log(amount_Arr);

    var total_amount = 0;
    for(var a=0;a<amount_Arr.length;a++)
    {
      var amount = amount_Arr[a].split(",").join("");
      total_amount += parseFloat(amount);
    }
     $("#historytotal_noncash").val(total_amount.toLocaleString());
  }

  function display_mop_js() {
    $.post('<?php echo base_url() ?>display_mop_route',
      function(data) {
               $("#noncash_trno").val(data.trno);
               $('#tbody_mop').html(data.html);
           }, 'json');
}

function save_noncash_denomination() {
  get_noncash_trno_js();
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
        setTimeout(function() {
          var tot = $('#total_noncash').val();
          var tot2 = tot.split(',').join('');
          var trno = $("#noncash_trno").val();
          var tr_no = ('0000000000' + trno).slice(-10);

          if(tot == '' || tot == '0')
          {
            Swal.fire('Missing Data', 'Total must not be empty or 0!', 'error')
          } 
          else
          {  
              var data_arr = $("#data").val().split("+");
              for(var a=1;a<data_arr.length;a++)
              {
                var amount_Arr = [];
                document.querySelectorAll("."+data_arr[a]).forEach(function(el)
                {
                  amount_Arr.push(el.value);
                });                     
                
                if($("#borrow_checkbox").is(':checked')){
                  $.ajax({
                    type: 'post',
                    url: '<?php echo base_url(); ?>save_noncashdenomination_borrowed_route',
                    data: {
                            'tr_no': tr_no,
                            'batch_id': $('#batch_id').val(),
                            'amount_Arr':amount_Arr,
                            'cash_section': $('#cash_section').val(),
                            'cash_subsection': $('#cash_subsection').val()
                          },
                    dataType: 'json',
                    success: function(data) 
                    {
                      if(data=='EXPIRED SESSION')
                      {
                          Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                        
                          setTimeout(function() {
                            window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                          }, 1000);
                      }
                      else if(data=='INVALID')
                      {
                          Swal.fire('INVALID BORROWED', 'You selected your default department, please select another section or sub section', 'error');
                          return;
                      }
                      else
                      {
                        Swal.fire('SUBMITTED', '', 'success');
                        setTimeout(function() {
                          $('#noncash_confirmationmodal').modal('toggle');
                          window.parent.location.href = "<?php echo base_url() ?>cashier_noncashform_route";
                        }, 1000);
                      }
                    }
                  });
                } else {
                  $.ajax({
                    type: 'post',
                    url: '<?php echo base_url(); ?>save_noncashdenomination_route',
                    data: {
                            'tr_no': tr_no,
                            'batch_id': $('#batch_id').val(),
                            'amount_Arr':amount_Arr
                          },
                    dataType: 'json',
                    success: function(data) 
                    {
                      if(data=='EXPIRED SESSION')
                      {
                          Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                        
                          setTimeout(function() {
                            window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                          }, 1000);
                      }
                      else
                      {
                        Swal.fire('SUBMITTED', '', 'success');
                        setTimeout(function() {
                          $('#noncash_confirmationmodal').modal('toggle');
                          window.parent.location.href = "<?php echo base_url() ?>cashier_noncashform_route";
                        }, 1000);
                      }
                    }
                  });
                }
              }
          }
        }, 500);
        
      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
}

function get_batchid_js()
{
    $.ajax({
        type:'post',
        url :'<?php echo base_url(); ?>get_batchid_route',
        dataType:'json',
        success: function(data)
        {                        
          $("#batch_id").val(data.batchid);
          if(data.cashpending == 'WALAY PENDING')
          {
            $("#borrow_checkbox").prop('disabled', false);
          }
        }
    })
}

function disabled_saveresetbtn_js()
{
    $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>disabled_saveresetbtn_route_v2',
      dataType: 'json',
      success: function(data) 
      {         
        if(data.status == 'PENDING') 
        {
            // console.log('naay pending');
            /*===================disabled textbox===========================*/
            document.getElementById("q_onek").disabled = true;
            document.getElementById("q_fiveh").disabled = true;
            document.getElementById("q_twoh").disabled = true;
            document.getElementById("q_oneh").disabled = true;
            document.getElementById("q_fifty").disabled = true;
            document.getElementById("q_twenty").disabled = true;
            document.getElementById("q_ten").disabled = true;
            document.getElementById("q_five").disabled = true;
            document.getElementById("q_one").disabled = true;
            document.getElementById("q_twentyfivecents").disabled = true;
            document.getElementById("q_tencents").disabled = true;
            document.getElementById("q_fivecents").disabled = true;
            document.getElementById("q_onecents").disabled = true;

            /*======================disabled button===========================*/
            document.getElementById("btn_reset_cashform").disabled = true;
            document.getElementById("btn_save_cashform").disabled = true;
            document.getElementById("partial_checkbox").disabled = true;
            document.getElementById("final_checkbox").disabled = true;
            display_pos_name_js();
            document.getElementById("pos_name").disabled = true;
            setTimeout(function() {
              $("#borrow_checkbox").prop('disabled', true);
              $("#borrow_checkbox").prop('checked', false);
              $("#cash_section_form").prop('hidden', true);
              $("#counter_no").text('');
            }, 1000);
            /*======================notification message=======================*/
            Swal.fire('NOTE!', 'You cannot save multiple cash denomination, please confirm first your pending cash denomination to your liquidation officer before you input another cash denomination🙂', 'info');
        }
        else
        {
            $("#cash_trno").val(data.trno);     
            /*===================disabled textbox===========================*/
            document.getElementById("q_onek").disabled = false;
            document.getElementById("q_fiveh").disabled = false;
            document.getElementById("q_twoh").disabled = false;
            document.getElementById("q_oneh").disabled = false;
            document.getElementById("q_fifty").disabled = false;
            document.getElementById("q_twenty").disabled = false;
            document.getElementById("q_ten").disabled = false;
            document.getElementById("q_five").disabled = false;
            document.getElementById("q_one").disabled = false;
            document.getElementById("q_twentyfivecents").disabled = false;
            document.getElementById("q_tencents").disabled = false;
            document.getElementById("q_fivecents").disabled = false;
            document.getElementById("q_onecents").disabled = false;

            /*======================disabled button===========================*/
            document.getElementById("btn_reset_cashform").disabled = false;
            document.getElementById("btn_save_cashform").disabled = false;
        }

        if(data.borrowed == 'YES')
        {
            $("#borrow_checkbox").prop('disabled', true);
            $("#borrow_checkbox").prop('checked', true);
            $("#cash_section_form").prop('hidden', false);
            $("#cash_section").prop('disabled', true);
            $("#cash_subsection").prop('disabled', true);
            $("#pos_name").prop('disabled', true);
            $("#cash_section").html(data.sname);
            $("#cash_subsection").html(data.ssname);
            $("#pos_name").html(data.pos_name);
            $("#counter_no").text(data.counter_no);
        }
        else if(data.borrowed == 'NO')
        {
            $("#borrow_checkbox").prop('disabled', true);
            $("#pos_name").prop('disabled', true);
            $("#pos_name").html(data.pos_name);
            $("#counter_no").text(data.counter_no);
        }
        else
        {
            $("#borrow_checkbox").prop('disabled', false);
        }
      }
    });
}

function disabled_saveresetbtn_js_v2()
{ 
    $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>disabled_saveresetbtn_route_v3',
      dataType: 'json',
      success: function(data) 
      {    
        if(data.status == 'PENDING' || data.status == 'CHECKED') 
        {
          Swal.fire('NOTE!', 'You cannot save multiple cash denomination, please confirm first your pending cash denomination to your liquidation officer before you input another cash denomination🙂', 'info');
            /*===================disabled textbox===========================*/
            document.getElementById("q_onek").disabled = true;
            document.getElementById("q_fiveh").disabled = true;
            document.getElementById("q_twoh").disabled = true;
            document.getElementById("q_oneh").disabled = true;
            document.getElementById("q_fifty").disabled = true;
            document.getElementById("q_twenty").disabled = true;
            document.getElementById("q_ten").disabled = true;
            document.getElementById("q_five").disabled = true;
            document.getElementById("q_one").disabled = true;
            document.getElementById("q_twentyfivecents").disabled = true;
            document.getElementById("q_tencents").disabled = true;
            document.getElementById("q_fivecents").disabled = true;
            document.getElementById("q_onecents").disabled = true;

            /*======================disabled button===========================*/
            document.getElementById("btn_reset_cashform").disabled = true;
            document.getElementById("btn_save_cashform").disabled = true;
            display_pos_name_js();
            document.getElementById("pos_name").disabled = true;
            setTimeout(function() {
              $("#borrow_checkbox").prop('disabled', true);
              $("#borrow_checkbox").prop('checked', false);
              $("#cash_section_form").prop('hidden', true);
              $("#counter_no").text('');
            }, 1000);
            /*======================notification message=======================*/
        }
        else
        {
          if(data.assigned_counter == 'NOT EMPTY')
          {  
            /*===================disabled textbox===========================*/
            document.getElementById("q_onek").disabled = false;
            document.getElementById("q_fiveh").disabled = false;
            document.getElementById("q_twoh").disabled = false;
            document.getElementById("q_oneh").disabled = false;
            document.getElementById("q_fifty").disabled = false;
            document.getElementById("q_twenty").disabled = false;
            document.getElementById("q_ten").disabled = false;
            document.getElementById("q_five").disabled = false;
            document.getElementById("q_one").disabled = false;
            document.getElementById("q_twentyfivecents").disabled = false;
            document.getElementById("q_tencents").disabled = false;
            document.getElementById("q_fivecents").disabled = false;
            document.getElementById("q_onecents").disabled = false;

            /*======================disabled button===========================*/
            document.getElementById("btn_reset_cashform").disabled = false;
            document.getElementById("btn_save_cashform").disabled = false;
            // =================================================================
            if(data.borrowed == 'YES')
            {
                $("#borrow_checkbox").prop('disabled', true);
                $("#borrow_checkbox").prop('checked', true);
                $("#cash_section_form").prop('hidden', false);
                $("#cash_section").prop('disabled', true);
                $("#cash_subsection").prop('disabled', true);
                $("#pos_name").prop('disabled', true);
                $("#cash_section").html(data.sname);
                $("#cash_subsection").html(data.ssname);
                $("#pos_name").html(data.pos_name);
                $("#counter_no").text(data.counter_no);
            }
            else
            {
                $("#borrow_checkbox").prop('disabled', true);
                $("#pos_name").prop('disabled', true);
                $("#pos_name").html(data.pos_name);
                $("#counter_no").text(data.counter_no);
            }
          }
          else
          {
            Swal.fire('MISSING COUNTER', 'You don\'t have assigned counter, please ask to your liquidation officer for assistance.', 'error');
            /*===================disabled textbox===========================*/
            document.getElementById("q_onek").disabled = true;
            document.getElementById("q_fiveh").disabled = true;
            document.getElementById("q_twoh").disabled = true;
            document.getElementById("q_oneh").disabled = true;
            document.getElementById("q_fifty").disabled = true;
            document.getElementById("q_twenty").disabled = true;
            document.getElementById("q_ten").disabled = true;
            document.getElementById("q_five").disabled = true;
            document.getElementById("q_one").disabled = true;
            document.getElementById("q_twentyfivecents").disabled = true;
            document.getElementById("q_tencents").disabled = true;
            document.getElementById("q_fivecents").disabled = true;
            document.getElementById("q_onecents").disabled = true;

            /*======================disabled button===========================*/
            document.getElementById("btn_reset_cashform").disabled = true;
            document.getElementById("btn_save_cashform").disabled = true;
            // display_pos_name_js();
            document.getElementById("pos_name").disabled = true;
            setTimeout(function() {
              $("#borrow_checkbox").prop('disabled', true);
              $("#borrow_checkbox").prop('checked', false);
              $("#cash_section_form").prop('hidden', true);
              $("#counter_no").text('');
            }, 1000);
          }
        }
      }
    });
}

function history_disabled_saveresetbtn_js()
{ 
    $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>disabled_saveresetbtn_route_v3',
      dataType: 'json',
      success: function(data) 
      {    
        if(data.status == 'PENDING' || data.status == 'CHECKED') 
        {
            /*===================disabled textbox===========================*/
            document.getElementById("q_onek").disabled = true;
            document.getElementById("q_fiveh").disabled = true;
            document.getElementById("q_twoh").disabled = true;
            document.getElementById("q_oneh").disabled = true;
            document.getElementById("q_fifty").disabled = true;
            document.getElementById("q_twenty").disabled = true;
            document.getElementById("q_ten").disabled = true;
            document.getElementById("q_five").disabled = true;
            document.getElementById("q_one").disabled = true;
            document.getElementById("q_twentyfivecents").disabled = true;
            document.getElementById("q_tencents").disabled = true;
            document.getElementById("q_fivecents").disabled = true;
            document.getElementById("q_onecents").disabled = true;

            /*======================disabled button===========================*/
            document.getElementById("btn_reset_cashform").disabled = true;
            document.getElementById("btn_save_cashform").disabled = true;
            display_pos_name_js();
            document.getElementById("pos_name").disabled = true;
            setTimeout(function() {
              $("#borrow_checkbox").prop('disabled', true);
              $("#borrow_checkbox").prop('checked', false);
              $("#cash_section_form").prop('hidden', true);
              $("#counter_no").text('');
            }, 1000);
            /*======================notification message=======================*/
        }
        else
        {
          if(data.assigned_counter == 'NOT EMPTY')
          {  
            /*===================disabled textbox===========================*/
            document.getElementById("q_onek").disabled = false;
            document.getElementById("q_fiveh").disabled = false;
            document.getElementById("q_twoh").disabled = false;
            document.getElementById("q_oneh").disabled = false;
            document.getElementById("q_fifty").disabled = false;
            document.getElementById("q_twenty").disabled = false;
            document.getElementById("q_ten").disabled = false;
            document.getElementById("q_five").disabled = false;
            document.getElementById("q_one").disabled = false;
            document.getElementById("q_twentyfivecents").disabled = false;
            document.getElementById("q_tencents").disabled = false;
            document.getElementById("q_fivecents").disabled = false;
            document.getElementById("q_onecents").disabled = false;

            /*======================disabled button===========================*/
            document.getElementById("btn_reset_cashform").disabled = false;
            document.getElementById("btn_save_cashform").disabled = false;
            // =================================================================
            if(data.borrowed == 'YES')
            {
                $("#borrow_checkbox").prop('disabled', true);
                $("#borrow_checkbox").prop('checked', true);
                $("#cash_section_form").prop('hidden', false);
                $("#cash_section").prop('disabled', true);
                $("#cash_subsection").prop('disabled', true);
                $("#pos_name").prop('disabled', true);
                $("#cash_section").html(data.sname);
                $("#cash_subsection").html(data.ssname);
                $("#pos_name").html(data.pos_name);
                $("#counter_no").text(data.counter_no);
            }
            else
            {
                $("#borrow_checkbox").prop('disabled', true);
                $("#pos_name").prop('disabled', true);
                $("#pos_name").html(data.pos_name);
                $("#counter_no").text(data.counter_no);
            }
          }
          else
          {
            Swal.fire('MISSING COUNTER', 'You don\'t have assigned counter, please ask to your liquidation officer for assistance.', 'error');
            /*===================disabled textbox===========================*/
            document.getElementById("q_onek").disabled = true;
            document.getElementById("q_fiveh").disabled = true;
            document.getElementById("q_twoh").disabled = true;
            document.getElementById("q_oneh").disabled = true;
            document.getElementById("q_fifty").disabled = true;
            document.getElementById("q_twenty").disabled = true;
            document.getElementById("q_ten").disabled = true;
            document.getElementById("q_five").disabled = true;
            document.getElementById("q_one").disabled = true;
            document.getElementById("q_twentyfivecents").disabled = true;
            document.getElementById("q_tencents").disabled = true;
            document.getElementById("q_fivecents").disabled = true;
            document.getElementById("q_onecents").disabled = true;

            /*======================disabled button===========================*/
            document.getElementById("btn_reset_cashform").disabled = true;
            document.getElementById("btn_save_cashform").disabled = true;
            document.getElementById("pos_name").disabled = true;
            setTimeout(function() {
              $("#borrow_checkbox").prop('disabled', true);
              $("#borrow_checkbox").prop('checked', false);
              $("#cash_section_form").prop('hidden', true);
              $("#counter_no").text('');
            }, 1000);
          }
        }
      }
    });
}

function view_cashconfimation_modal()
{
    disabled_saveresetbtn_js_v2();
    if ($('#checkbox_cashremit').val() == '') 
    {
      Swal.fire('MISSING DATA', 'Please select partial or final remit before submit', 'error');
    } 
    else if($('#total_cash').val() == '' || $('#total_cash').val() == 0)
    {
      Swal.fire('MISSING DATA', 'Total must not be empty or 0', 'error');
    }
    else if($('#counter_no').text() == '')
    {
      Swal.fire('MISSING POS NO.', 'Please select POS number', 'error');
    }
    else if($('#checkbox_cashremit').val() == 'PARTIAL')
    {
        var crt = $('#checkbox_cashremit').val();
        var pos = $('#pos_name option:selected').text();
        var counter = $('#pos_name option:selected').val();
        var q1k = $('#q_onek').val();
        var a1k = $('#a_onek').val();
        var q5h = $('#q_fiveh').val();
        var a5h = $('#a_fiveh').val();
        var q2h = $('#q_twoh').val();
        var a2h = $('#a_twoh').val();
        var q1h = $('#q_oneh').val();
        var a1h = $('#a_oneh').val();
        var q5f = $('#q_fifty').val();
        var a5f = $('#a_fifty').val();
        var q20 = $('#q_twenty').val();
        var a20 = $('#a_twenty').val();
        var ctot = $('#total_cash').val();
       
        $('#cash_confirmationmodal').appendTo("body").modal('show');

        if($("#borrow_checkbox").is(':checked'))
        {
            $("#cash_borrow_lbl").text(' - BORROWED');
            if($("#cash_section option:selected").text() == 'SELECT SECTION')
            {
              $('#section_lbl').show();
              $('#section_txt').text('');
              $('#space_lbl').show();
              $('#sub_section_lbl').show();
              $('#sub_section_txt').text('');
            }
            else
            {
              if($("#cash_subsection option:selected").text() == 'SELECT SUB SECTION')
              {
                $('#section_lbl').show();
                $('#section_txt').show();
                $('#space_lbl').show();
                $('#sub_section_lbl').show();
                $('#sub_section_txt').show();

                $("#section_txt").text($("#cash_section option:selected").text());
                $('#sub_section_txt').text('');
              }
              else
              {
                $('#section_lbl').show();
                $('#section_txt').show();
                $('#space_lbl').show();
                $('#sub_section_lbl').show();
                $('#sub_section_txt').show();
                
                $("#section_txt").text($("#cash_section option:selected").text());
                $("#sub_section_txt").text($("#cash_subsection option:selected").text());
              }
            }
        } 
        else 
        {
            $("#cash_borrow_lbl").text('');
            $('#section_lbl').hide();
            $('#section_txt').hide();
            $('#space_lbl').hide();
            $('#sub_section_lbl').hide();
            $('#sub_section_txt').hide();
            $('.br').hide();
        }

        $('#cmodalcashremit_type').text(crt+'  REMITTANCE');
        $('#pos').text(pos+' | ');
        $('#counter').text(counter);
        $('#q_onekm').text(q1k);
        $('#a_onekm').text(a1k);
        $('#q_fivehm').text(q5h);
        $('#a_fivehm').text(a5h);
        $('#q_twohm').text(q2h);
        $('#a_twohm').text(a2h);
        $('#q_onehm').text(q1h);
        $('#a_onehm').text(a1h);
        $('#q_fiftym').text(q5f);
        $('#a_fiftym').text(a5f);
        $('#q_twentym').text(q20);
        $('#a_twentym').text(a20);
        $('#total_cashm').text(ctot);
    }
    else
    {
        var crt = $('#checkbox_cashremit').val();
        var pos = $('#pos_name option:selected').text();
        var counter = $('#pos_name option:selected').val();
        var q1k = $('#q_onek').val();
        var a1k = $('#a_onek').val();
        var q5h = $('#q_fiveh').val();
        var a5h = $('#a_fiveh').val();
        var q2h = $('#q_twoh').val();
        var a2h = $('#a_twoh').val();
        var q1h = $('#q_oneh').val();
        var a1h = $('#a_oneh').val();
        var q5f = $('#q_fifty').val();
        var a5f = $('#a_fifty').val();
        var q20 = $('#q_twenty').val();
        var a20 = $('#a_twenty').val();
        var q10 = $('#q_ten').val();
        var a10 = $('#a_ten').val();
        var q5 = $('#q_five').val();
        var a5 = $('#a_five').val();
        var q1 = $('#q_one').val();
        var a1 = $('#a_one').val();
        var q25c = $('#q_twentyfivecents').val();
        var a25c = $('#a_twentyfivecents').val();
        var q10c = $('#q_tencents').val();
        var a10c = $('#a_tencents').val();
        var q5c = $('#q_fivecents').val();
        var a5c = $('#a_fivecents').val();
        var q1c = $('#q_onecents').val();
        var a1c = $('#a_onecents').val();
        var ctot = $('#total_cash').val();

        $('#cash_confirmationmodal').appendTo("body").modal('show');

        if($("#borrow_checkbox").is(':checked'))
        {
            $("#cash_borrow_lbl").text(' - BORROWED');
            if($("#cash_section option:selected").text() == 'SELECT SECTION')
            {
              $('#section_lbl').show();
              $('#section_txt').text('');
              $('#space_lbl').show();
              $('#sub_section_lbl').show();
              $('#sub_section_txt').text('');
            }
            else
            {
              if($("#cash_subsection option:selected").text() == 'SELECT SUB SECTION')
              {
                $('#section_lbl').show();
                $('#section_txt').show();
                $('#space_lbl').show();
                $('#sub_section_lbl').show();
                $('#sub_section_txt').show();

                $("#section_txt").text($("#cash_section option:selected").text());
                $('#sub_section_txt').text('');
              }
              else
              {
                $('#section_lbl').show();
                $('#section_txt').show();
                $('#space_lbl').show();
                $('#sub_section_lbl').show();
                $('#sub_section_txt').show();
                
                $("#section_txt").text($("#cash_section option:selected").text());
                $("#sub_section_txt").text($("#cash_subsection option:selected").text());
              }
            }
        } 
        else 
        {
            $("#cash_borrow_lbl").text('');
            $('#section_lbl').hide();
            $('#section_txt').hide();
            $('#space_lbl').hide();
            $('#sub_section_lbl').hide();
            $('#sub_section_txt').hide();
            $('.br').hide();
        }

        $('#cmodalcashremit_type').text(crt+'  REMITTANCE');
        $('#pos').text(pos+' | ');
        $('#counter').text(counter);
        $('#q_onekm').text(q1k);
        $('#a_onekm').text(a1k);
        $('#q_fivehm').text(q5h);
        $('#a_fivehm').text(a5h);
        $('#q_twohm').text(q2h);
        $('#a_twohm').text(a2h);
        $('#q_onehm').text(q1h);
        $('#a_onehm').text(a1h);
        $('#q_fiftym').text(q5f);
        $('#a_fiftym').text(a5f);
        $('#q_twentym').text(q20);
        $('#a_twentym').text(a20);
        $('#q_tenm').text(q10);
        $('#a_tenm').text(a10);
        $('#q_fivem').text(q5);
        $('#a_fivem').text(a5);
        $('#q_onem').text(q1);
        $('#a_onem').text(a1);
        $('#q_twentyfivecentsm').text(q25c);
        $('#a_twentyfivecentsm').text(a25c);
        $('#q_tencentsm').text(q10c);
        $('#a_tencentsm').text(a10c);
        $('#q_fivecentsm').text(q5c);
        $('#a_fivecentsm').text(a5c);
        $('#q_onecentsm').text(q1c);
        $('#a_onecentsm').text(a1c);
        $('#total_cashm').text(ctot);

        document.getElementById("trmodalcash_onecents").hidden = false;
        document.getElementById("trmodalcash_fivecents").hidden = false;
        document.getElementById("trmodalcash_tencents").hidden = false;
        document.getElementById("trmodalcash_twentyfivecents").hidden = false;
        document.getElementById("trmodalcash_one").hidden = false;
        document.getElementById("trmodalcash_five").hidden = false;
        document.getElementById("trmodalcash_ten").hidden = false;
    }

}

function disabled_noncashform()
{
  $.ajax({
    type: 'post',
    url: '<?php echo base_url(); ?>disabled_noncashform_route',
    dataType: 'json',
    success: function(data) 
    {
      if(data == 'PENDING') 
      {
          // console.log('naay pending');
          /*======================disabled button===========================*/
          document.getElementById("btn_reset_noncashform").disabled = true;
          document.getElementById("btn_save_noncashform").disabled = true;
          $("input.dis").attr("disabled", true);
          /*======================notification message=======================*/
          Swal.fire('NOTE!', 'You cannot save multiple noncash denomination, please confirm first your pending noncash denomination to your liquidation officer before you input another cash denomination🙂', 'info');
          setTimeout(function() {
            $("#borrow_checkbox").prop('disabled', true);
          }, 1000);
      }
      else
      {
          // console.log('walay pending');
          /*======================enabled button===========================*/
          document.getElementById("btn_reset_noncashform").disabled = false;
          document.getElementById("btn_save_noncashform").disabled = false;
          $("input.dis").attr("disabled", false);
      }
    }
  });
}

function get_cash_trno_js()
{
  $.ajax({
      type:'post',
      url :'<?php echo base_url(); ?>get_cash_trno_route',
      dataType:'json',
      success: function(data)
      {      
          save_cash_denomination(data.trno);
      }
  })
}

function get_noncash_trno_js()
{ 
  $.ajax({
      type:'post',
      url :'<?php echo base_url(); ?>get_noncash_trno_route',
      dataType:'json',
      success: function(data)
      {                          
          add_mop_js(data.trno);
      }
  })
}

function view_noncashconfimation_modal()
{
  get_noncash_trno_js();
  if ($('#checkbox_noncashremit').val() == '') 
  {
    Swal.fire('MISSING DATA', 'Please select partial or final remit before submit', 'error');
  } 
  else if($('#total_noncash').val() == '' || $('#total_noncash').val() == 0)
  {
    Swal.fire('MISSING DATA', 'Total must not be empty or 0', 'error');
  }
  else
  {

      var nctot = $('#total_noncash').val();
      var data_noncashm = $("#data").val().split("+");

        $("#tbody_noncash_confirmationmodal").html("");

        var amount_Arr = [];
        for(var a=1;a<data_noncashm.length;a++)
        {
            document.querySelectorAll("."+data_noncashm[a]).forEach(function(el)
            {
              amount_Arr.push(el.value);
            // console.log(data_noncashm[a]);
            });        
        }
        
        var qty = [];
        var amt = [];
        for(var b=0;b<amount_Arr.length;b+=4)
        {
          // console.log(amount_Arr[b], amount_Arr[b+2], amount_Arr[b+3]);
            qty.push(amount_Arr[b+2]);
            amt.push(amount_Arr[b+3]); 
        }


        var result='OK';  
        for(var c=0;c<qty.length;c++)
        {
          
          if( (qty[c] == '0' && amt[c] != '0.00') || (qty[c] != '0' && qty[c] != ''   && amt[c] == '0.00' )  || (qty[c] == '' && amt[c] != '0.00')  || (qty[c] != '' && qty[c] == '0'  && amt[c] != '0.00'))  
          {
            result ='ERROR';
          }      

        }
        
        if(result == 'OK')
        {
          $.ajax({
                    type:'post',
                    url :'<?php echo base_url(); ?>view_noncashmodal_route',
                    data: {
                            'total_noncash': $('#total_noncash').val(),
                            'amount_Arr':amount_Arr
                          },
                    dataType:'json',
                    success: function(data)
                    { 
                      if(data == 'MISSING DATA')
                      {
                        Swal.fire('MISSING DATA', 'Please check your quantity and amount', 'error');
                        return;
                      } 
                      else
                      {      
                        $("#tbody_noncash_confirmationmodal").append(data.html);
                        $('#noncash_confirmationmodal').modal('show');
                        $('#total_noncashm_modal').text(nctot);

                        if($("#borrow_checkbox").is(':checked'))
                        {
                            $("#noncash_borrow_lbl").text('BORROWED');
                            if($("#cash_section option:selected").text() == 'SELECT SECTION')
                            {
                              $('#section_lbl').show();
                              $('#section_txt').text('');
                              $('#space_lbl').show();
                              $('#sub_section_lbl').show();
                              $('#sub_section_txt').text('');
                            }
                            else
                            {
                              if($("#cash_subsection option:selected").text() == 'SELECT SUB SECTION')
                              {
                                $('#section_lbl').show();
                                $('#section_txt').show();
                                $('#space_lbl').show();
                                $('#sub_section_lbl').show();
                                $('#sub_section_txt').show();

                                $("#section_txt").text($("#cash_section option:selected").text());
                                $('#sub_section_txt').text('');
                              }
                              else
                              {
                                $('#section_lbl').show();
                                $('#section_txt').show();
                                $('#space_lbl').show();
                                $('#sub_section_lbl').show();
                                $('#sub_section_txt').show();
                                
                                $("#section_txt").text($("#cash_section option:selected").text());
                                $("#sub_section_txt").text($("#cash_subsection option:selected").text());
                              }
                            }
                        } 
                        else 
                        {
                            $("#noncash_borrow_lbl").text('');
                            $('#section_lbl').hide();
                            $('#section_txt').hide();
                            $('#space_lbl').hide();
                            $('#sub_section_lbl').hide();
                            $('#sub_section_txt').hide();
                        }
                      } 
                    }
                })
        }
        else 
        {
          Swal.fire('MISSING DATA', 'Please check your quantity and amount', 'error');
          return;
        }
  }

}

function checked_partial()
{
    document.getElementById("final_checkbox").checked = false;

    var partial = document.getElementById("partial_checkbox");
    if (partial.checked) 
    {
      $('#checkbox_cashremit').val('PARTIAL');
      document.getElementById("trcash_onecents").hidden = true;
      document.getElementById("trcash_fivecents").hidden = true;
      document.getElementById("trcash_tencents").hidden = true;
      document.getElementById("trcash_twentyfivecents").hidden = true;
      document.getElementById("trcash_one").hidden = true;
      document.getElementById("trcash_five").hidden = true;
      document.getElementById("trcash_ten").hidden = true;

      $('#q_onecents').val(0);
      $('#q_fivecents').val(0);
      $('#q_tencents').val(0);
      $('#q_twentyfivecents').val(0);
      $('#q_one').val(0);
      $('#q_five').val(0);
      $('#q_ten').val(0);

      calculate_breakdown_js();
    }
    else
    {
      $('#checkbox_cashremit').val('');
    }
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
            //  console.log(data.html);                           
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

function history_checked_borrow()
{
  var cash_borrow = document.getElementById("cash_borrow_checkbox");
  if(cash_borrow.checked)
  {
    document.getElementById("cash_section_form").hidden = false;
    document.getElementById("cash_section_form2").hidden = true;

    $("#cash_section").html("");
    $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>get_section_route',
          dataType:'json',
          success: function(data)
          { 
            //  console.log(data.html);                           
             $("#cash_section").html(data.html);
             get_sub_section_js();
          }
      })
  }
  else
  {
    document.getElementById("cash_section_form").hidden = true;
    validate_cash_borrowed_js_v2();
  } 
}

function history_noncash_checked_borrow()
{
  var noncash_borrow = document.getElementById("noncash_borrow_checkbox");
  if(noncash_borrow.checked)
  {
    document.getElementById("noncash_section_form").hidden = false;
    document.getElementById("noncash_section_form2").hidden = true;

    $("#noncash_section").html("");
    $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>get_section_route',
          dataType:'json',
          success: function(data)
          {                        
             $("#noncash_section").html(data.html);
             history_noncash_get_sub_section_js();
          }
      })
  }
  else
  {
    document.getElementById("noncash_section_form").hidden = true;
    validate_noncash_borrowed_js();
  } 
}

function checked_final()
{
    document.getElementById("partial_checkbox").checked = false;

    var final = document.getElementById("final_checkbox");
      if (final.checked) 
      {
        $('#checkbox_cashremit').val('FINAL');
        document.getElementById("trcash_onecents").hidden = false;
        document.getElementById("trcash_fivecents").hidden = false;
        document.getElementById("trcash_tencents").hidden = false;
        document.getElementById("trcash_twentyfivecents").hidden = false;
        document.getElementById("trcash_one").hidden = false;
        document.getElementById("trcash_five").hidden = false;
        document.getElementById("trcash_ten").hidden = false;
      } 
      else
      {
        $('#checkbox_cashremit').val('');
        document.getElementById("trcash_onecents").hidden = true;
        document.getElementById("trcash_fivecents").hidden = true;
        document.getElementById("trcash_tencents").hidden = true;
        document.getElementById("trcash_twentyfivecents").hidden = true;
        document.getElementById("trcash_one").hidden = true;
        document.getElementById("trcash_five").hidden = true;
        document.getElementById("trcash_ten").hidden = true;
      }
}

function checked_noncashpartial()
{
    document.getElementById("final_noncashcheckbox").checked = false;

    var partial = document.getElementById("partial_noncashcheckbox");
      if (partial.checked) 
      {
       $('#checkbox_noncashremit').val('PARTIAL');
      }
      else
      {
        $('#checkbox_noncashremit').val('');
      }
}

function checked_noncashfinal()
{
    document.getElementById("partial_noncashcheckbox").checked = false;

    var final = document.getElementById("final_noncashcheckbox");
      if (final.checked) 
      {
        $('#checkbox_noncashremit').val('FINAL');
      } 
      else
      {
        $('#checkbox_noncashremit').val('');
      }
}

function disabled_partialcheckbox_js()
{
   $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>disabled_partialcheckbox_route',
              dataType: 'json',
              success: function(data) {
                //console.log(data);

                if(data=='NOT EMPTY')
                {
                  document.getElementById('partial_checkbox').disabled = true;
                  Swal.fire('NOTE!', 'You already submit partial remit, you can select final remit only🙂', 'info');
                }
              }
            });
}

function displayhistory_noncashform_js() 
{ 
  $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>displayhistory_noncashform_route_v2',
      dataType: 'json',
      success: function(data) {
        if(data.borrowed == 'YES')
        {
          $("#noncash_borrow_checkbox").prop('checked', true);
          $("#noncash_section_form2").prop('hidden', false);
          $("#noncash_section2").val(data.sname);
          $("#noncash_subsection2").val(data.ssname);
        }
        $('#noncashremit_type').html(data.remit_type+'&nbsp;&nbsp;REMITTANCE');
        $('#noncash_pos_name2').val(data.pos_name);
        $('#noncash_counter_no2').val(data.counter_no);
        $('#history_mop_name').html(data.mop_list);
        $('#history_noncashdiv_mop').html(data.html);
        if(data.add_mop == 'ENABLED')
        {
          $("#history_mop_name").prop('disabled', false);
          $("#history_nc_quantity").prop('disabled', false);
          $("#history_nc_amount").prop('disabled', false);
          $("#history_plus_btn").prop('disabled', false);
        }
        else
        {
          $("#history_mop_name").prop('disabled', true);
          $("#history_nc_quantity").prop('disabled', true);
          $("#history_nc_amount").prop('disabled', true);
          $("#history_plus_btn").prop('disabled', true);
        }
      }
  });
}

function enable_noncash_updatebtn_js(edit_borrowed,edit_pos,pos_name)
{
  if(edit_borrowed == 'ENABLED')
  {
    $('#noncash_borrow_checkbox').prop('disabled', false);
  }
  if(edit_pos == 'ENABLED')
  {
    display_history_noncash_pos_name_js(pos_name);
    $('#noncash_pos_form').prop('hidden', false);
  }
  else
  {
    $('#noncash_pos_form').prop('hidden', true);
  }
}

  function enabled_historynoncash_quantity_js()
  {
    var hncashid = $("#historyncashid").text().split("+");
      // console.log(hncashid);
 
     for(var a=1;a<hncashid.length;a++)
     {
       document.getElementById(hncashid[a]).disabled = false;
       document.getElementById("btn_edit_historyncashform").disabled = true;
       document.getElementById("btn_update_historyncashform").disabled = false;
       document.getElementById("btn_cancel_historyncashform").disabled = false;
       document.getElementById("noncash_borrow_checkbox").disabled = false;
     }     

  }

  function canceledit_historynoncash_denomination()
  {
     window.parent.location.href = "<?php echo base_url() ?>cashier_historyform_route";
  }

  function update_historynoncashform_js()
  {
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

          var tot = $('#historytotal_noncash').val();
          var tot2 = tot.split(',').join('');
          // var id = $('#history_cashform_id').val();
             // console.log(tot2);

          if(tot == '' || tot == '0')
           {
             Swal.fire('Missing Data', 'Total must not be empty or 0!', 'error')
           } 
           else
           {
              var data_arr = $("#hncash_data").text().split("+");
              // console.log(data_arr);
              for(var a=1;a<data_arr.length;a++)
              {
               
                var amount_Arr = [];
                document.querySelectorAll("."+data_arr[a]).forEach(function(el)
                {
                  amount_Arr.push(el.value);
                });                     
                  
                  if($("#noncash_borrow_checkbox").is(':checked')){
                    $.ajax({
                      type: 'post',
                      url: '<?php echo base_url(); ?>update_historynoncashform_borrowed_route',
                      data: {
                              'batch_id': $('#hncash_bid').text(),
                              'amount_Arr':amount_Arr,
                              'noncash_section': $('#noncash_section').val(),
                              'noncash_subsection': $('#noncash_subsection').val() 
                            },
                      dataType: 'json',
                      success: function(data) {
                          //console.log(data);
                          // Swal.fire('Successfully Update!', '', 'success');
                          if(data=='EXPIRED SESSION')
                          {
                              Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                            
                              setTimeout(function() {
                                window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                              }, 1000);
                          }
                      }
                    });
                  } else {
                    $.ajax({
                      type: 'post',
                      url: '<?php echo base_url(); ?>update_historynoncashform_route',
                      data: {
                              'batch_id': $('#hncash_bid').text(),
                              'amount_Arr':amount_Arr
                            },
                      dataType: 'json',
                      success: function(data) {
                          //console.log(data);
                          // Swal.fire('Successfully Update!', '', 'success');
                          if(data=='EXPIRED SESSION')
                          {
                              Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                            
                              setTimeout(function() {
                                window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                              }, 1000);
                          }
                      }
                    });
                  }
              }
                 Swal.fire('UPDATED', '', 'success');

                 setTimeout(function() {
                    window.parent.location.href = "<?php echo base_url() ?>cashier_historyform_route";
                  }, 1000);
          }

        } else if (result.isDenied) {
          Swal.fire('CANCELLED', '', 'info')
        }
      })
  }

  function disabled_scharacter_js()
  {

                // Catch all events related to changes
                $('.cash_quantity').on('change keyup top press', function() {
                  // Remove invalid characters
                  var sanitized = $(this).val().replace(/[^0-9]/g, '');
                 // Update value
                  $(this).val(sanitized);
                  calculate_breakdown_js();
                });


    /*=============================================Disabled (-+e)================================================================*/
                                document.querySelector(".quantity").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity1").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity2").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity3").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity4").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity5").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity6").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity7").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity8").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity9").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity10").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity11").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });

                                document.querySelector(".quantity12").addEventListener("keypress", function (evt) {
                                    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                                    {
                                        evt.preventDefault();
                                    }
                                });
        /*============================================================================================================================*/

  }

  function view_hpartialdetails_js()
  {
    $('#hpartialdetails_modal').modal('show');
    $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>display_hpartialdetails_route',
            dataType: 'json',
            success: function(data) {
              $('#hpartialdetails_bodymodal').html(data.html);
            }
          });
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
             // console.log(data.html);                           
             $("#cash_subsection").html(data.html);
          }
      })
  }

  function history_noncash_get_sub_section_js()
  {
    // console.log($("#cash_section").val());
    $("#noncash_subsection").html("");
    $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>get_sub_section_route',
          data:{'section_code': $("#noncash_section").val()},
          dataType:'json',
          success: function(data)
          { 
             // console.log(data.html);                           
             $("#noncash_subsection").html(data.html);
          }
      })
  }

  function validate_cash_borrowed_js()
  {
    $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>validate_cash_borrowed_route',
            dataType: 'json',
            success: function(data) {
              if(data.message == 'BORROWED')
              {
                document.getElementById("cash_section_form2").hidden = false;
                $("#cash_section2").val(data.sname);
                $("#cash_subsection2").val(data.ssname);
              }
              else
              {
                document.getElementById("cash_section_form2").hidden = true;
              }
              // =============================================================
              if(data.edit_pos == 'ENABLED')
              {
                display_history_pos_name_js(data.pos_name);
                document.getElementById("cash_pos_form").hidden = false;
                document.getElementById("btn_update_cashform").disabled = false;
                document.getElementById("btn_cancel_cashform").disabled = false;
              }
              $("#pos_name2").val(data.pos_name);
              $("#counter_no2").val(data.counter_no);
            }
          });
  }

  function validate_cash_borrowed_js_v2()
  {
    $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>validate_cash_borrowed_route_v2',
        dataType: 'json',
        success: function(data) {
          if(data.message == 'BORROWED')
          {
            $("#cash_borrow_checkbox").prop('checked', true);
            document.getElementById("cash_section_form2").hidden = false;
            $("#cash_section2").val(data.sname);
            $("#cash_subsection2").val(data.ssname);
          }
          else
          {
            $("#cash_borrow_checkbox").prop('checked', false);
            document.getElementById("cash_section_form2").hidden = true;
          }
          // =============================================================
          $("#pos_name2").val(data.pos_name);
          $("#counter_no2").val(data.counter_no);
        }
    });
  }

  function validate_noncash_borrowed_js()
  {
    $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>validate_noncash_borrowed_route',
      dataType: 'json',
      success: function(data) {
        if(data.message == 'BORROWED')
        {
          document.getElementById("noncash_section_form2").hidden = false;
          $("#noncash_section2").val(data.sname);
          $("#noncash_subsection2").val(data.ssname);
        }
        else
        {
          document.getElementById("noncash_section_form2").hidden = true;
        }
      }
    })
  }

  function validate_cash_access_js()
  { 
    $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>validate_cash_access_route',
        dataType: 'json',
        success: function(data) {
          if(data == 'NO ACCESS')
          {
                document.getElementById("q_onek").disabled = true;
                document.getElementById("q_fiveh").disabled = true;
                document.getElementById("q_twoh").disabled = true;
                document.getElementById("q_oneh").disabled = true;
                document.getElementById("q_fifty").disabled = true;
                document.getElementById("q_twenty").disabled = true;
                document.getElementById("q_ten").disabled = true;
                document.getElementById("q_five").disabled = true;
                document.getElementById("q_one").disabled = true;
                document.getElementById("q_twentyfivecents").disabled = true;
                document.getElementById("q_tencents").disabled = true;
                document.getElementById("q_fivecents").disabled = true;
                document.getElementById("q_onecents").disabled = true;

              /*======================disabled button===========================*/
                document.getElementById("btn_reset_cashform").disabled = true;
                document.getElementById("btn_save_cashform").disabled = true;
                document.getElementById("borrow_checkbox").disabled = true;
                document.getElementById("pos_name").disabled = true;

                /*======================notification message=======================*/
                Swal.fire('NO ACCESS', 'You don\'t have access to this form, please ask for assistance to your liquidation officer🙂', 'error');
          }
          else if(data == 'VALIDATED')
          {
            disabled_saveresetbtn_js_v2();
          }
        }
      });
  }

  function validate_edit_cash_js()
  {
    $.ajax({
      type: 'post',
      url: '<?php echo base_url(); ?>validate_edit_cash_route',
      dataType: 'json',
      success: function(data) {
        var edit_den = data.edit_den;
        var edit_den_status = data.edit_den_status;
          if(edit_den_status == 'ENABLED')
          {
            $('#btn_cancel_cashform').prop('disabled', false);
            $('#btn_update_cashform').prop('disabled', false);

            var allow_edit = edit_den.split(',');

            if(allow_edit.indexOf("1k") !== -1){
                // alert("Value exists!")
            } else{
                // alert("Value does not exists!")
                $('#q_onek').prop('disabled', false);
            }
            if(allow_edit.indexOf("5h") !== -1){
                // alert("Value exists!")
            } else{
                // alert("Value does not exists!")
                $('#q_fiveh').prop('disabled', false);
            }
            if(allow_edit.indexOf("2h") !== -1){
                // alert("Value exists!")
            } else{
                // alert("Value does not exists!")
                $('#q_twoh').prop('disabled', false);
            }
            if(allow_edit.indexOf("1h") !== -1){
                // alert("Value exists!")
            } else{
                // alert("Value does not exists!")
                $('#q_oneh').prop('disabled', false);
            }
            if(allow_edit.indexOf("fifty") !== -1){
                // alert("Value exists!")
            } else{
                // alert("Value does not exists!")
                $('#q_fifty').prop('disabled', false);
            }
            if(allow_edit.indexOf("twenty") !== -1){
                // alert("Value exists!")
            } else{
                // alert("Value does not exists!")
                $('#q_twenty').prop('disabled', false);
            }
            if(allow_edit.indexOf("ten") !== -1){
                // alert("Value exists!")
            } else{
                // alert("Value does not exists!")
                $('#q_ten').prop('disabled', false);
            }
            if(allow_edit.indexOf("five") !== -1){
                // alert("Value exists!")
            } else{
                // alert("Value does not exists!")
                $('#q_five').prop('disabled', false);
            }
            if(allow_edit.indexOf("one") !== -1){
                // alert("Value exists!")
            } else{
                // alert("Value does not exists!")
                $('#q_one').prop('disabled', false);
            }
            if(allow_edit.indexOf("twenty_fc") !== -1){
                // alert("Value exists!")
            } else{
                // alert("Value does not exists!")
                $('#q_twentyfivecents').prop('disabled', false);
            }
            if(allow_edit.indexOf("ten_c") !== -1){
                // alert("Value exists!")
            } else{
                // alert("Value does not exists!")
                $('#q_tencents').prop('disabled', false);
            }
            if(allow_edit.indexOf("five_c") !== -1){
                // alert("Value exists!")
            } else{
                // alert("Value does not exists!")
                $('#q_fivecents').prop('disabled', false);
            }
            if(allow_edit.indexOf("one_c") !== -1){
                // alert("Value exists!")
            } else{
                // alert("Value does not exists!")
                $('#q_onecents').prop('disabled', false);
            }
          }
      }
    });
  }

  function view_previous_den_js()
  {
    if($("#from_date").val() > $("#to_date").val())
    {
      Swal.fire('INVALID DATE', 'From: is never greater than to To:', 'error');
      return;
    }
    else
    {
      $('#divbody_previous_table').html('');
      $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>view_previous_den_route',
            data: {'from': $("#from_date").val(),
                   'to': $("#to_date").val()
            },
            dataType: 'json',
            success: function(data) {
              if(data=='EXPIRED SESSION')
              {
                  Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                
                  setTimeout(function() {
                    window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                  }, 1000);
              }
              else
              {
                $('#divbody_previous_table').html(data.html);
                previous_datatable();
              }
            }
          });
    }
  }

  function previous_datatable() 
  {
    $(document).ready(function() {
      $('#previous_den_table').DataTable({
        "columnDefs": 
        [
          {"className": "text-center", "targets": [0,1,2,3,4,5]}
        ],
        "order": [
          [0, "desc"]
        ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
      });
    });
  }

  function display_pos_name_js()
  {
      $("#borrow_checkbox").prop('disabled', false);
      $("#pos_name").prop('disabled', false);
      $("#counter_no").text('');
      $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>display_pos_name_route',
          dataType: 'json',
          success: function(data) {
              $("#pos_name").html(data.html);
          }
      });
  }

  function display_history_pos_name_js(pos_name)
  {
      $("#pos_name").prop('disabled', false);
      $("#counter_no").text('');
      $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>display_history_pos_name_route',
          data: {'pos_name': pos_name},
          dataType: 'json',
          success: function(data) {
              $("#pos_name").html(data.html);
          }
      });
  }

  function display_history_noncash_pos_name_js(pos_name)
  {
      $("#pos_name").prop('disabled', false);
      $("#counter_no").text('');
      $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>display_history_pos_name_route',
          data: {'pos_name': pos_name},
          dataType: 'json',
          success: function(data) {
              $("#noncash_pos_name").html(data.html);
          }
      });
  }

  function get_counter_no_js()
  {
      if($("#pos_name option:selected").text() != 'Select POS')
      {
        var counter_no = $("#pos_name option:selected").val();
        $("#counter_no").text(counter_no);
      }
  }

  function get_noncash_counter_no_js()
  {
      if($("#pos_name option:selected").text() != 'Select POS')
      {
        var counter_no = $("#noncash_pos_name option:selected").val();
        $("#noncash_counter_no").text(counter_no);
      }
  }

  function validate_borrowed_js()
  {
    display_mop_js_v2();
    display_sample_js();
    $("#borrow_checkbox").prop('checked', false);
    $("#cash_section_form").prop('hidden', true);
    $("#cash_section").prop('disabled', false);
    $("#cash_subsection").prop('disabled', false);
    $("#pos_name").prop('disabled', false);
    $("#counter_no").prop('disabled', false);
    $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>validate_borrowed_route',
        dataType: 'json',
        success: function(data) {
          if(data.borrowed == 'YES')
          {
              $("#borrow_checkbox").prop('checked', true);
              $("#cash_section_form").prop('hidden', false);
              $("#cash_section").prop('disabled', true);
              $("#cash_subsection").prop('disabled', true);
              $("#pos_name").prop('disabled', true);
              $("#noncash_trno").val(data.tr_no);
              $("#cash_section").html(data.sname);
              $("#cash_subsection").html(data.ssname);
              $("#pos_name").html(data.pos_name);
              $("#counter_no").text(data.counter_no);
          }
          else if(data.borrowed == 'NO')
          {
              $("#borrow_checkbox").prop('disabled', true);
              $("#pos_name").prop('disabled', true);
              $("#noncash_trno").val(data.tr_no);
              $("#pos_name").html(data.pos_name);
              $("#counter_no").text(data.counter_no);
          }
          else
          {
              $("#noncash_trno").val(data.tr_no);
          }
          if(data.message == 'WALAY PENDING')
          {
              display_pos_name_js();
          }
        }
    });
  }

  function validate_borrowed_js_v2()
  {
    display_mop_js_v2();
    display_sample_js();
    $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>validate_borrowed_route_v2',
        dataType: 'json',
        success: function(data) {
          if(data.assigned_counter == 'NOT EMPTY')
          { 
            if(data.borrowed == 'YES')
            {
                $("#borrow_checkbox").prop('checked', true);
                $("#cash_section_form").prop('hidden', false);
                $("#cash_section").prop('disabled', true);
                $("#cash_subsection").prop('disabled', true);
                $("#pos_name").prop('disabled', true);
                $("#cash_section").html(data.sname);
                $("#cash_subsection").html(data.ssname);
                $("#pos_name").html(data.pos_name);
                $("#counter_no").text(data.counter_no);
            }
            else
            {
                $("#borrow_checkbox").prop('disabled', true);
                $("#pos_name").prop('disabled', true);
                $("#pos_name").html(data.pos_name);
                $("#counter_no").text(data.counter_no);
            }
          }
          else
          {
              $("#pos_form").prop('hidden', true);
              $("#borrow_checkbox").prop('disabled', true);
              $("#mop_name").prop('disabled', true);
              $("#nc_quantity").prop('disabled', true);
              $("#nc_amount").prop('disabled', true);
              $("#plus_btn").prop('disabled', true);
              $("#save_noncash_btn").prop('disabled', true);
              Swal.fire('MISSING COUNTER', 'You don\'t have assigned counter, please ask to your liquidation officer for assistance.', 'error')
          }
        }
    });
  }

  function display_mop_js_v2()
  {
    $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>display_mop_route_v2',
          dataType: 'json',
          success: function(data) {
            if(data.message == 'NO ACCESS')
            {
              $("#borrow_checkbox").prop('disabled', true);
              $("#pos_name").prop('disabled', true);
              $("#mop_name").prop('disabled', true);
              $("#nc_quantity").prop('disabled', true);
              $("#nc_amount").prop('disabled', true);
              $("#plus_btn").prop('disabled', true);
              $("#save_noncash_btn").prop('disabled', true);
              Swal.fire('NO ACCESS', "You don\'t have access to this module, please ask to your liquidation officer for assistance.", 'error')
            }
            else
            {
              $("#mop_name").html(data.html);
            }
          }
      });
  }

  function add_mop_js(trno)
  { 
    if($("#pos_name option:selected").text() == 'Select POS')
    {
      Swal.fire('MISSING POS', 'Please select POS before add.', 'error')
      return;
    }
    else if($("#mop_name option:selected").text() == 'Select MOP')
    {
      Swal.fire('MISSING MOP', 'Please select MODE OF PAYMENT before add.', 'error')
      return;
    }
    else if($("#nc_quantity").val() == '' || $("#nc_quantity").val() == 0)
    {
      Swal.fire('MISSING QUANTITY', 'Please input QUANTITY before add.', 'error')
      return;
    }
    else if($("#nc_amount").val() == '' || $("#nc_amount").val() == 0)
    {
      Swal.fire('MISSING AMOUNT', 'Please input AMOUNT before add.', 'error')
      return;
    }
    else
    {
      var nc_amount = $("#nc_amount").val().split(",").join("");
      var tr_no = ('0000000000' + trno).slice(-10);

      if($("#borrow_checkbox").is(':checked'))
      {
        if($("#cash_section option:selected").text() == 'SELECT SECTION')
        {
          Swal.fire('MISSING SECTION', 'If borrowed, please select SECTION before add.', 'error')
          return;
        }
        else
        {
            $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>save_noncashdenomination_borrowed_route_v2',
              data: {'tr_no': tr_no,
                     'pos_name': $('#pos_name option:selected').text(),
                     'counter_no': $('#counter_no').text(),
                     'mop_name': $('#mop_name option:selected').text(),
                     'nc_quantity': $('#nc_quantity').val(),
                     'nc_amount': nc_amount,
                     'cash_section': $('#cash_section option:selected').val(),
                     'cash_subsection': $('#cash_subsection option:selected').val()
                    },
              dataType: 'json',
              success: function(data) 
              { console.log(data);
                if(data=='EXPIRED SESSION')
                {
                    Swal.fire('EXPIRED SESSION', '', 'error')
                  
                    setTimeout(function() {
                      window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                    }, 1000);
                }
                else if(data == 'ALREADY EXIST')
                {
                    Swal.fire('ALREADY EXIST', 'Please select another MODE OF PAYMENT', 'error')
                }
                else if(data=='TRNO ALREADY USED')
                {
                  Swal.fire('EXPIRED SESSION', '', 'error');
                
                  setTimeout(function() {
                    window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                    }, 1000);
                }
                else
                {
                    display_sample_js();
                }
              }
            });
        }
      } 
      else 
      {
        $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>save_noncashdenomination_route_v2',
          data: {'tr_no': tr_no,
                  'pos_name': $('#pos_name option:selected').text(),
                  'counter_no': $('#counter_no').text(),
                  'mop_name': $('#mop_name option:selected').text(),
                  'nc_quantity': $('#nc_quantity').val(),
                  'nc_amount': nc_amount
                },
          dataType: 'json',
          success: function(data) 
          {
            if(data == 'EXPIRED SESSION')
            {
                Swal.fire('EXPIRED SESSION', '', 'error')
              
                setTimeout(function() {
                  window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                }, 1000);
            }
            else if(data == 'ALREADY EXIST')
            {
                Swal.fire('ALREADY EXIST', 'Please select another MODE OF PAYMENT', 'error')
            }
            else if(data=='TRNO ALREADY USED')
            {
              Swal.fire('EXPIRED SESSION', '', 'error');
            
              setTimeout(function() {
                window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                }, 1000);
            }
            else
            {
                display_sample_js();
            }
          }
        });
      }
    }
  }

  function validate_sample_js()
  {
      $("#nc_quantity").val('');
      $("#nc_amount").val('');
      $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>validate_sample_route',
            dataType: 'json',
            success: function(data) {
                if(data.borrowed == 'YES')
                {
                    $("#borrow_checkbox").prop('checked', true);
                    $("#cash_section_form").prop('hidden', false);
                    $("#cash_section").prop('disabled', true);
                    $("#cash_subsection").prop('disabled', true);
                    $("#pos_name").prop('disabled', true);
                    $("#cash_section").html(data.sname);
                    $("#cash_subsection").html(data.ssname);
                    $("#pos_name").html(data.pos_name);
                    $("#counter_no").text(data.counter_no);
                }
                else
                {
                    $("#borrow_checkbox").prop('disabled', true);
                    $("#pos_name").prop('disabled', true);
                    $("#pos_name").html(data.pos_name);
                    $("#counter_no").text(data.counter_no);
                }
            }
      });
  }

  function display_sample_js()
  {
      $("#div_mop").html('');
      $("#save_noncash_btn").prop('disabled', false);
      $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>display_sample_route',
          dataType: 'json',
          success: function(data) {
              $("#div_mop").html(data.html);
              if(data.message == 'NAAY SAMPLE')
              {
                validate_sample_js();
              }
              else
              {
                $("#save_noncash_btn").prop('disabled', true);
              }
          }
      });
  }

  function sample_datatable() 
  {
    $(document).ready(function() {
      $('#nc_mop_table').DataTable({
        "columnDefs": 
        [
          {"className": "text-center", "targets": [0,1,2,3]}
        ]
      });
    });
  }

  function delete_nc_sample_js(id,mop)
  {
      Swal.fire({
      title: mop,
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
        if (result.isConfirmed) 
        {
          $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>delete_nc_sample_route',
                data: {'id': id},
                dataType: 'json',
                success: function(data) {
                  if(data == 'EXPIRED SESSION')
                  {
                      Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                    
                      setTimeout(function() {
                        window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                      }, 1000);
                  }
                  else
                  {
                      validate_borrowed_js_v2();
                      Swal.fire('DELETED', '', 'success')
                  }
                }
          });
        } else if (result.isDenied) {
          Swal.fire('CANCELLED', '', 'info')
        }
      })
  }

  function submit_noncash_js()
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
        if (result.isConfirmed) 
        {
            $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>submit_noncash_route',
                dataType: 'json',
                success: function(data) {
                    if(data == 'EXPIRED SESSION')
                    {
                        Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                      
                        setTimeout(function() {
                          window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                        }, 1000);
                    }
                    else
                    {
                        $("#nc_quantity").val('');
                        $("#nc_amount").val('');
                        validate_borrowed_js_v2();
                        Swal.fire('SUBMITTED', '', 'success')
                        setTimeout(function() {
                          check_pending_js();
                        }, 2000);
                    }
                }
              });
        } else if (result.isDenied) {
          Swal.fire('CANCELLED', '', 'info')
        }
      })
  }

  function check_pending_js()
  {
      $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>check_pending_route',
        dataType: 'json',
        success: function(data) {
            if(data == 'NAAY PENDING')
            {
                display_pos_name_js();
                $("#borrow_checkbox").prop('disabled', true);
                $("#borrow_checkbox").prop('checked', false);
                $("#cash_section_form").prop('hidden', true);
                $("#pos_name").prop('disabled', true);
                $("#mop_name").prop('disabled', true);
                $("#nc_quantity").prop('disabled', true);
                $("#nc_amount").prop('disabled', true);
                $("#plus_btn").prop('disabled', true);
                $("#save_noncash_btn").prop('disabled', true);
                $("#counter_no").text('');
                Swal.fire('NOTE!', 'You have a pending noncash denomination, please confirm first to your liquidation officer before input another noncash denomination.', 'info')
            }
        }
      });
  }

  function update_noncash_borrowed_js()
  {
    if($("#noncash_section option:selected").text() == 'SELECT SECTION')
    {
      Swal.fire('MISSING SECTION', 'Please select section before update', 'error')
    }
    else
    {
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
          if (result.isConfirmed) 
          {
              $.ajax({
                  type: 'post',
                  url: '<?php echo base_url(); ?>update_noncash_borrowed_route',
                  data: {'scode': $("#noncash_section").val(),
                        'sscode': $("#noncash_subsection").val()
                  },
                  dataType: 'json',
                  success: function(data) {
                      if(data == 'EXPIRED SESSION')
                      {
                          Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                        
                          setTimeout(function() {
                            window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                          }, 1000);
                      }
                      else if(data == 'ALREADY EXIST')
                      {
                          Swal.fire('ALREADY EXIST', 'Please select another section or sub senction', 'error')
                      }
                      else if(data == 'INVALID BORROWED')
                      {
                          Swal.fire('INVALID BORROWED', 'You selected your default department, please select another section or sub section', 'error')
                      }
                      else
                      {
                          validate_cash_borrowed_js();
                          $("#noncash_borrow_checkbox").prop('checked', false);
                          $("#noncash_borrow_checkbox").prop('disabled', true);
                          Swal.fire('UPDATED', '', 'success');
                          history_noncash_checked_borrow();
                      }
                  }
                });
          } else if (result.isDenied) {
            Swal.fire('CANCELLED', '', 'info')
          }
        })
    }
  }

  function update_noncash_pos_js()
  {
    if($("#noncash_pos_name option:selected").text() == 'Select POS')
    {
      Swal.fire('MISSING POS', 'Please select pos before update', 'error')
    }
    else
    {
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
          if (result.isConfirmed) 
          {
              $.ajax({
                  type: 'post',
                  url: '<?php echo base_url(); ?>update_noncash_pos_route',
                  data: {'pos_name': $("#noncash_pos_name option:selected").text(),
                         'counter_no': $("#noncash_counter_no").text()
                  },
                  dataType: 'json',
                  success: function(data) {
                      if(data == 'EXPIRED SESSION')
                      {
                          Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                        
                          setTimeout(function() {
                            window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                          }, 1000);
                      }
                      else
                      {
                          validate_cash_borrowed_js();
                          displayhistory_noncashform_js();
                          Swal.fire('UPDATED', '', 'success')
                      }
                  }
                });
          } else if (result.isDenied) {
            Swal.fire('CANCELLED', '', 'info')
          }
        })
    }
  }

  function delete_history_noncash_pending_js(id,mop,edit_den)
  {
    if(edit_den == 'ENABLED')
    {
      Swal.fire({
      title: mop,
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
        if (result.isConfirmed) 
        {
          $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>delete_history_noncash_pending_route',
                data: {'id': id},
                dataType: 'json',
                success: function(data) {
                  if(data == 'EXPIRED SESSION')
                  {
                      Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                    
                      setTimeout(function() {
                        window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                      }, 1000);
                  }
                  else
                  {
                      displayhistory_noncashform_js();
                      Swal.fire('DELETED', '', 'success')
                  }
                }
          });
        } else if (result.isDenied) {
          Swal.fire('CANCELLED', '', 'info')
        }
      })
    }
  }

  function edit_history_noncash_pending_js(id,qty,amount,edit_den)
  {
    if(edit_den == 'ENABLED')
    {
      $('#history_edit_modal').modal({
          backdrop: 'static',
          keyboard: false
      });
      $('#history_edit_modal').modal('show');
      $("#edit_nc_quantity").val(qty);
      $("#edit_nc_amount").val(amount);
      $("#edit_mop_id").text(id);
      get_edit_mop_js(id);
    }
  }

  function get_edit_mop_js(id)
  {
      $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>get_edit_mop_route',
            data: {'id': id},
            dataType: 'json',
            success: function(data) {
                $("#edit_mop_name").html(data.html);
            }
      });
  }

  function update_history_noncash_mop_js()
  {
    if($("#edit_nc_quantity").val() == '' || $("#edit_nc_quantity").val() <= 0)
    {
      Swal.fire('MISSING QUANTITY', 'Please input quantity before update.', 'error');
      return;
    }
    else if($("#edit_nc_amount").val() == '' || $("#edit_nc_amount").val() <= 0)
    {
      Swal.fire('MISSING AMOUNT', 'Please input amount before update.', 'error');
      return;
    }
    else
    {
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
        if (result.isConfirmed) 
        {
          var amount = $("#edit_nc_amount").val().split(",").join("");
          $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>update_history_noncash_mop_route',
              data: {'id': $("#edit_mop_id").text(),
                    'mop_name': $("#edit_mop_name option:selected").text(),
                    'qty': $("#edit_nc_quantity").val(),
                    'amount': amount
              },
              dataType: 'json',
              success: function(data) {
                  if(data == 'EXPIRED SESSION')
                  {
                      Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                    
                      setTimeout(function() {
                        window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                      }, 1000);
                  }
                  else if(data == 'ALREADY EXIST')
                  {
                      Swal.fire('ALREADY EXIST', 'Please select another mode of payment', 'error');
                  }
                  else
                  {
                      displayhistory_noncashform_js();
                      Swal.fire('UPDATED', '', 'success')
                      $('#history_edit_modal').modal('toggle');
                  }
              }
          });
        } else if (result.isDenied) {
          Swal.fire('CANCELLED', '', 'info')
        }
      })
    }
  }

  function history_add_mop_js()
  {
    if($("#history_mop_name option:selected").text() == 'Select MOP')
    {
      Swal.fire('MISSING MOP', 'Please select MODE OF PAYMENT before add.', 'error')
      return;
    }
    else if($("#history_nc_quantity").val() == '' || $("#history_nc_quantity").val() == 0)
    {
      Swal.fire('MISSING QUANTITY', 'Please input QUANTITY before add.', 'error')
      return;
    }
    else if($("#history_nc_amount").val() == '' || $("#history_nc_amount").val() == 0)
    {
      Swal.fire('MISSING AMOUNT', 'Please input AMOUNT before add.', 'error')
      return;
    }
    else
    {
      Swal.fire({
      title: 'Are you sure you want to add?',
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
          var amount = $("#history_nc_amount").val().split(",").join("");
          $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>history_add_mop_route',
              data: {'mop_name': $("#history_mop_name option:selected").text(),
                      'qty': $("#history_nc_quantity").val(),
                      'amount': amount
              },
              dataType: 'json',
              success: function(data) {
                if(data == 'EXPIRED SESSION')
                {
                    Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                  
                    setTimeout(function() {
                      window.parent.location.href = "<?php echo base_url() ?>cashier_dashboard_route";
                    }, 1000);
                }
                else if(data == 'NO DATA')
                {
                    Swal.fire('INVALID ADD', 'You don\'t have pending noncash denomination, you can add noncash denomination to the noncash form not in history.', 'error');
                }
                else
                {
                    $("#history_nc_quantity").val('');
                    $("#history_nc_amount").val('');
                    displayhistory_noncashform_js();
                    Swal.fire('ADDED', '', 'success');
                }
              }
          });
        } else if (result.isDenied) {
          Swal.fire('CANCELLED', '', 'info')
        }
      })
    }
  }

  function update_remit_type_js()
  {
    if($("#partial_checkbox").prop('checked') == false && $("#final_checkbox").prop('checked') == false)
    {
      Swal.fire('MISSING REMITTANCE TYPE', 'Please select remittance type before update.', 'error');
    }
    else
    {
      Swal.fire({
      title: 'Are you sure you want to update remittance type?',
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
          var type = 'PARTIAL';
          if($("#final_checkbox").prop('checked') == true)
          {
            type = 'FINAL';
          }
          $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>update_remit_type_route',
              data: {'id': $('#history_cashform_id').val(),
                      'type': type
              },
              dataType: 'json',
              success: function(data) {
                if(data == 'EXPIRED SESSION')
                {
                    Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                  
                    setTimeout(function() {
                      window.parent.location.href = "<?php echo base_url() ?>cashier_historyform_route";
                    }, 1000);
                }
                else
                {
                    Swal.fire('UPDATED', '', 'success');
                    setTimeout(function() {
                      window.parent.location.href = "<?php echo base_url() ?>cashier_historyform_route";
                    }, 1000);
                }
              }
          });
        } else if (result.isDenied) {
          Swal.fire('CANCELLED', '', 'info')
        }
      })
    }
  }

</script>