<!-- swal alert -->
<script src="<?php echo base_url('assets/js/dataTables.fixedHeader.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2@11.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.min.js'); ?>"></script>


<script>

  function submit_cfscashiercash_js() {

    Swal.fire({
      title: 'Are you sure you want to submit?',
      text: 'Please check your denomination first before submit',
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

        var tot = $('#total_cash').val();
        var tot2 = tot.split(',').join('');
          // console.log(tot);

         if(tot == '' || tot == '0')
         {
           Swal.fire('Missing Data', 'Total must not be empty or 0!', 'error')
         } 
         else
         {
               var cash_form_counter_last = $("#cash_form_counter").val(); 
               var trno = $("#cash_trno").val();
               var tr_no = ('0000000000' + trno).slice(-10);

               var form_entry =0;
               var datas = '';
               var dup = [];

               for(var a=0;a<parseInt(cash_form_counter_last);a++)
               {
                  var total = $(".quantity"+a).val(); 
                 
                  if(form_entry == 13)
                  {
                      total =$(".quantity"+a).val().split(',').join('');

                      if(total == '' || total == '0')
                      {
                        Swal.fire('Missing Data', 'Total must not be empty or 0!', 'error')
                        return;
                      }
                  }

                  if(form_entry == 14)
                  {
                      var cash = $(".quantity"+a).val();
        
                      if(dup.includes(cash))
                      {
                        Swal.fire('DUPLICATE: '+cash, 'Please check your cash type before submit', 'error')
                        return;
                      } 
                      else 
                      {
                        dup.push(cash);
                      }

                  }

                   datas =datas+"_"+total;

                   form_entry+=1;

                   if(form_entry==15)
                   {
                    datas = datas+'^';
                    form_entry =0;
                   }

               } 
               

               datas = datas.split("^");           

               for(var b=0;b<datas.length-1;b++)
               {
                   // console.log(datas[b]);
                   $.ajax({
                      type:'post',
                      url: '<?php echo base_url(); ?>submit_cfscashiercash_route',
                      data:{'datas':datas[b],
                            'tr_no': tr_no,
                            'status': 'PENDING',
                            'date': datetime
                            },
                      dataType:'json',
                      success: function(data)
                      {
                         // console.log(data);  
                         if(data=='EXPIRED SESSION')
                          {
                             Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                           
                             setTimeout(function() {
                               window.parent.location.href = "<?php echo base_url() ?>cfscashier_denomination_route";
                              }, 1000);
                          }
                          else
                          {
                               Swal.fire('Successfully Submit!', '', 'success')    
                          
                               setTimeout(function() {
                                window.parent.location.href = "<?php echo base_url() ?>cfscashier_denomination_route";
                              }, 1000);
                          }
                      }
                    });
                }
        }

      } else if (result.isDenied) {
        Swal.fire('Cancel Submit!', '', 'info')
      }
    })
  }

  function display_cfsothermop_js()
  {
       $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>display_cfsothermop_route',
          dataType:'json',
          success: function(data)
          { 
            
             // console.log(data.html);
             $("#cash_trno").val(data.cash_tr_no);                           
             $("#noncash_trno").val(data.noncash_tr_no);                           
             $("#cfs_cashmop").html(data.html);
          }

      })
  }

  function display_forex_currency_js()
  {
    $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>display_forex_currency_route',
          dataType:'json',
          success: function(data)
          { 
             // console.log(data.html);                           
             $("#forex_trno").val(data.tr_no);
             $("#cfs_forex_list").html(data.html);
             display_forex_denomination_form_js();
          }

      })
  }

  function display_forex_denomination_form_js()
  {
    var currency = $("#cfs_forex_list").val();
    // console.log(currency);
    $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>display_forex_denomination_form_route',
          data:{'currency':currency},
          dataType:'json',
          success: function(data)
          {  
             // console.log(data.html);                           
             $("#cfscashier_forextbody").html(data.html);
             disabled_cfs_forex_form_js();
          }

      })
  }

  function cfscalculate_breakdown_js() {

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
  }

  function cfsforex_tfccalculation_js()
  {
    var res1 = $('#q_fiveh').val() * 500;
    var res2 = $('#q_twoh').val() * 200;
    var res3 = $('#q_oneh').val() * 100;
    var res4 = $('#q_fifty').val() * 50;
    var res5 = $('#q_twenty').val() * 20;
    var res6 = $('#q_ten').val() * 10;
    var res7 = $('#q_five').val() * 5;
    var res8 = $('#q_two').val() * 2;
    var res9 = $('#q_one').val() * 1;
    /* if (res == Number.POSITIVE_INFINITY || res == Number.NEGATIVE_INFINITY || isNaN(res))
    res = "N/A"; // OR 0*/
    var amount1 = res1;
    var amount2 = res2;
    var amount3 = res3;
    var amount4 = res4;
    var amount5 = res5;
    var amount6 = res6;
    var amount7 = res7;
    var amount8 = res8;
    var amount9 = res9;

    var amount13 = parseFloat(amount1) + 
                   parseFloat(amount2) + 
                   parseFloat(amount3) + 
                   parseFloat(amount4) + 
                   parseFloat(amount5) + 
                   parseFloat(amount6) + 
                   parseFloat(amount7) + 
                   parseFloat(amount8) + 
                   parseFloat(amount9) ;

    $('#tfc_fiveh').val(amount1.toLocaleString());
    $('#tfc_twoh').val(amount2.toLocaleString());
    $('#tfc_oneh').val(amount3.toLocaleString());
    $('#tfc_fifty').val(amount4.toLocaleString());
    $('#tfc_twenty').val(amount5.toLocaleString());
    $('#tfc_ten').val(amount6.toLocaleString());
    $('#tfc_five').val(amount7.toLocaleString());
    $('#tfc_two').val(amount8.toLocaleString());
    $('#tfc_one').val(amount9.toLocaleString());

    //   ====================TOTAL=====================================
    $('#total_forex_fc').val(amount13.toLocaleString());

    cfsforex_ercalculation_js();

    if($("#tfc_fiveh").val() != '0')
    {
      document.getElementById("er_fiveh").disabled = false;
    }
    else
    {
      document.getElementById("er_fiveh").disabled = true;
      document.getElementById("er_fiveh").value = '0';
    }

    if( $("#tfc_twoh").val() != '0')
    {
      document.getElementById("er_twoh").disabled = false;
    }
    else
    {
      document.getElementById("er_twoh").disabled = true;
      document.getElementById("er_twoh").value = '0';
    }

    if( $("#tfc_oneh").val() != '0')
    {
      document.getElementById("er_oneh").disabled = false;
    }
    else
    {
      document.getElementById("er_oneh").disabled = true;
      document.getElementById("er_oneh").value = '0';
    }

    if( $("#tfc_fifty").val() != '0')
    {
      document.getElementById("er_fifty").disabled = false;
    }
    else
    {
      document.getElementById("er_fifty").disabled = true;
      document.getElementById("er_fifty").value = '0';
    }

    if( $("#tfc_twenty").val() != '0')
    {
      document.getElementById("er_twenty").disabled = false;
    }
    else
    {
      document.getElementById("er_twenty").disabled = true;
      document.getElementById("er_twenty").value = '0';
    }

    if( $("#tfc_ten").val() != '0')
    {
      document.getElementById("er_ten").disabled = false;
    }
    else
    {
      document.getElementById("er_ten").disabled = true;
      document.getElementById("er_ten").value = '0';
    }

    if( $("#tfc_five").val() != '0')
    {
      document.getElementById("er_five").disabled = false;
    }
    else
    {
      document.getElementById("er_five").disabled = true;
      document.getElementById("er_five").value = '0';
    }

    if( $("#tfc_two").val() != '0')
    {
      document.getElementById("er_two").disabled = false;
    }
    else
    {
      document.getElementById("er_two").disabled = true;
      document.getElementById("er_two").value = '0';
    }

    if( $("#tfc_one").val() != '0')
    {
      document.getElementById("er_one").disabled = false;
    }
    else
    {
      document.getElementById("er_one").disabled = true;
      document.getElementById("er_one").value = '0';
    }

  }

  function display_cfsncashmop_js()
  {
    $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>display_cfsncashmop_route',
          dataType:'json',
          success: function(data)
          { 
             // console.log(data.html);                           
             $("#cfs_ncashmop").html(data.html);
          }
      })
  }

  function display_cfsncashbankname_js()
  {
    $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>display_cfsncashbankname_route',
          dataType:'json',
          success: function(data)
          { 
             // console.log(data.html);                           
             $("#cfs_ncash_bankname").html(data.html);
          }
      })
  }

  function cfstotal_noncash_js()
  {

    var amount_Arr = [];
    document.querySelectorAll(".cfsncash_d_amount").forEach(function(el)
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

     $("#cfstotal_noncash").val(total_amount.toLocaleString());
  
  }

  function reset_cfscashierform_js()
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

          window.parent.location.href = "<?php echo base_url() ?>cfscashier_denomination_route"; 
       
        } else if (result.isDenied) {
          Swal.fire('Cancel reset', '', 'info')
        }
      })
  }

  function submit_cfsncash_js()
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

        var tot = $('#total_noncash').val();
        var tot2 = tot.split(',').join('');
        // console.log(tot);

         if(tot == '' || tot == '0')
         {
          Swal.fire('Missing Data', 'Total must not be empty or 0!', 'error')
         } 
         else
         {
               
              var data_arr = $("#cfsdata").val().split("+");
              for(var a=1;a<data_arr.length;a++)
              {
               
                var amount_Arr = [];
                document.querySelectorAll("."+data_arr[a]).forEach(function(el)
                {
                  amount_Arr.push(el.value);
                });                     
                
                      $.ajax({

                              type: 'post',
                              url: '<?php echo base_url(); ?>submit_cfsncash_route',
                              data: {
                                     'cfsbatch_id': $('#cfsbatch_id').val(),
                                     'amount_Arr':amount_Arr,
                                     'status':'PENDING',
                                     'date':datetime
                                    },
                              dataType: 'json',
                              success: function(data) {
                                 console.log(data);

                                if(data=='EXPIRED SESSION')
                                {
                                   Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                                 
                                   setTimeout(function() {
                                     window.parent.location.href = "<?php echo base_url() ?>cfscashier_dashboard_route";
                                    }, 1000);
                                }
                              }
                            });

              }
               Swal.fire('Successfully Submit!', '', 'success');

                 setTimeout(function() {
                    window.parent.location.href = "<?php echo base_url() ?>cfscashier_dashboard_route";
                  }, 1000);
        }

      } else if (result.isDenied) {
        Swal.fire('Cancel Submit', '', 'info')
      }
    })

  }

  function get_cfsbatchid_js()
  {
     $.ajax({
                type:'post',
                url :'<?php echo base_url(); ?>get_cfsbatchid_route',
                dataType:'json',
                success: function(data)
                { 
                  // console.log(data);                           
                  $("#cfsbatch_id").val(data.batchid);
                }

            })
  }

  function disabled_cfs_forex_form_js()
  {
    $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>disabled_cfs_forex_form_route',
                dataType: 'json',
                success: function(data) 
                {
                   // console.log(data);
                 if(data == 'PENDING') 
                 {

                      /*======================notification message=======================*/
                     Swal.fire('NOTE!', 'Please confirm first your pending forex domination to your liquidation officer before you input another forex denomination. THANK YOU AND GODBLESS🙂', 'info');

                     // console.log('naay pending');
                     /*===================disabled textbox===========================*/
                     document.getElementById("cfs_forex_list").disabled = true;
                     document.getElementById("forex_plus").disabled = true;
                     document.getElementById("forex_minus").disabled = true;
                     document.getElementById("q_fiveh").disabled = true;
                     document.getElementById("q_twoh").disabled = true;
                     document.getElementById("q_oneh").disabled = true;
                     document.getElementById("q_fifty").disabled = true;
                     document.getElementById("q_twenty").disabled = true;
                     document.getElementById("q_ten").disabled = true;
                     document.getElementById("q_five").disabled = true;
                     document.getElementById("q_two").disabled = true;
                     document.getElementById("q_one").disabled = true;

                    /*======================disabled button===========================*/
                     document.getElementById("submit_cfsforexden").disabled = true;
                     document.getElementById("reset_cfsforexden").disabled = true;

                 }
                 else
                 {
                     // console.log('walay pending');
                     /*===================disabled textbox===========================*/
                     document.getElementById("cfs_forex_list").disabled = false;
                     document.getElementById("forex_plus").disabled = false;
                     document.getElementById("forex_minus").disabled = false;
                     document.getElementById("q_fiveh").disabled = false;
                     document.getElementById("q_twoh").disabled = false;
                     document.getElementById("q_oneh").disabled = false;
                     document.getElementById("q_fifty").disabled = false;
                     document.getElementById("q_twenty").disabled = false;
                     document.getElementById("q_ten").disabled = false;
                     document.getElementById("q_five").disabled = false;
                     document.getElementById("q_two").disabled = false;
                     document.getElementById("q_one").disabled = false;

                    /*======================disabled button===========================*/
                     document.getElementById("submit_cfsforexden").disabled = false;
                     document.getElementById("reset_cfsforexden").disabled = false;

                 }

                }
              });
  }

  function disabled_cfssaveresetbtn_js()
  {
      $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>disabled_cfssaveresetbtn_route',
                dataType: 'json',
                success: function(data) 
                {
                   // console.log(data);
                 if(data == 'PENDING') 
                 {

                      /*======================notification message=======================*/
                     Swal.fire('NOTE!', 'Please confirm first your pending cash denomination to your liquidation officer before you input another cash denomination. THANK YOU AND GODBLESS🙂', 'info');

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
                     document.getElementById("reset_cfscashden").disabled = true;
                     document.getElementById("submit_cfscashden").disabled = true;
                     document.getElementById("cfs_cashmop").disabled = true;
                     document.getElementById("cash_plus").disabled = true;
                     document.getElementById("noncash_minus").disabled = true;

                 }
                 else
                 {
                     // console.log('walay pending');
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
                     document.getElementById("reset_cfscashden").disabled = false;
                     document.getElementById("submit_cfscashden").disabled = false;
                     document.getElementById("cfs_cashmop").disabled = false;
                     document.getElementById("cash_plus").disabled = false;
                     document.getElementById("noncash_minus").disabled = false;

                 }

                }
              });

  }

  function disabled_cfsnoncashform_js()
  {

    $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>disabled_cfsnoncashform_route',
                dataType: 'json',
                success: function(data) 
                {
                   // console.log(data);
                 if(data == 'PENDING') 
                 {
                     // console.log('naay pending');
                    /*======================disabled button===========================*/
                     document.getElementById("cfs_ncashmop").disabled = true;
                     document.getElementById("noncash_plus").disabled = true;
                     document.getElementById("noncash_minus").disabled = true;
                     document.getElementById("cfs_ncash_bankname").disabled = true;
                     document.getElementById("cheq_no").disabled = true;
                     document.getElementById("ncash_amount").disabled = true;
                     document.getElementById("submit_cfsnoncashden").disabled = true;
                     document.getElementById("reset_cfsnoncashden").disabled = true;
                     
                     /*======================notification message=======================*/
                     Swal.fire('NOTE!', 'Please confirm first your pending noncash denomination to your liquidation officer before you input another noncash denomination. THANK YOU AND GODBLESS🙂', 'info');
                 }
                 else
                 {
                     // console.log('walay pending');
                    /*======================enabled button===========================*/
                     document.getElementById("cfs_ncashmop").disabled = false;
                     document.getElementById("noncash_plus").disabled = false;
                     document.getElementById("noncash_minus").disabled = false;
                     document.getElementById("cfs_ncash_bankname").disabled = false;
                     document.getElementById("cheq_no").disabled = false;
                     document.getElementById("ncash_amount").disabled = false;
                     document.getElementById("submit_cfsnoncashden").disabled = false;
                     document.getElementById("reset_cfsnoncashden").disabled = false;
                 }

                }
              });

  }

  var counter = 0;
  function cash_duplicate_js()
  {

    var div_id = counter++;
    // console.log(div_id);
    var cash_form_counter = $("#cash_form_counter").val(); 

    var current_val = $("#cfscash_counter").val(); 
    $("#cfscash_counter").val(current_val+"_div"+div_id); 

    $.ajax({
                type:'post',
                url :'<?php echo base_url(); ?>cash_duplicate_route',
                data: {
                       'id': div_id,
                       'cash_form_counter':cash_form_counter
                      },
                dataType:'json',
                success: function(data)
                { 
                  // console.log(data.html);                           
                  $(".cfscash_add").append(data.html);
                  $("#cash_form_counter").val(data.cash_form_counter_last);
                }

            })
  }

  var noncash_counter = 0;
  function noncash_duplicate()
  {

    var div_id = noncash_counter++;
    // console.log(div_id);
    var noncash_form_counter = $("#noncash_form_counter").val(); 

    var current_val = $("#counter").val(); 
    $("#counter").val(current_val+"_divnoncash"+div_id); 

    $.ajax({
                type:'post',
                url :'<?php echo base_url(); ?>noncash_duplicate_route',
                data: {
                       'id': div_id,
                       'noncash_form_counter':noncash_form_counter
                      },
                dataType:'json',
                success: function(data)
                { 
                  // console.log(data.html);                           
                  $(".cfsnoncash_add").append(data.html);
                  $("#noncash_form_counter").val(data.noncash_form_counter_last);
                }

            })
  }

  function submit_cfsnoncashden_js()
  {
    Swal.fire({
      title: 'Are you sure you want to submit?',
      text: 'Please check your denomination first before submit',
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

        var cheq = $('.cheq_no').val();
        var amount = $('.ncashd_amount').val();
          // console.log(tot);

         if(cheq == '' || cheq == '0' || amount == '' || amount == 0.00)
         {
           Swal.fire('Missing Data', 'Cheque No. and Amount must not be empty or 0!', 'error')
         } 
         else
         {
               var noncash_form_counter_last = $("#noncash_form_counter").val(); 
               var trno = $("#noncash_trno").val();
               var tr_no = ('0000000000' + trno).slice(-10);

               var form_entry =0;
               var datas = '';
               // var dup = [];

               for(var a=0;a<parseInt(noncash_form_counter_last);a++)
               {
                  var amount = $(".noncash_class"+a).val(); 

                  if(form_entry == 3)
                  {
                      amount =$(".noncash_class"+a).val().split(',').join('');
                      
                      if(amount == '' || amount == 0.00)
                      {
                        Swal.fire('Missing Data', 'Amount must not be empty or 0!', 'error')
                        return;
                      }
                  }
                  else if(form_entry == 2)
                  {
                      if(amount == '' || amount == '0')
                        {
                          Swal.fire('Missing Data', 'Cheque No. must not be empty or 0!', 'error')
                          return;
                        }
                  }

                 /* if(form_entry == 0)
                  {
                      var noncash = $(".noncash_class"+a).val();
        
                      if(dup.includes(noncash))
                      {
                        Swal.fire('DUPLICATE: '+noncash, 'Please check your noncash type before submit', 'error')
                        return;
                      } 
                      else 
                      {
                        dup.push(noncash);
                      }

                  }*/

                   datas =datas+"_"+amount;

                   form_entry+=1;

                   if(form_entry==4)
                   {
                    datas = datas+'^';
                    form_entry =0;
                   }

               } 
               

               datas = datas.split("^");           

               for(var b=0;b<datas.length-1;b++)
               {
                  // console.log('ni sulod ani');
                   $.ajax({
                      type:'post',
                      url: '<?php echo base_url(); ?>submit_cfscashiernoncash_route',
                      data:{'datas':datas[b],
                            'tr_no': tr_no,
                            'status': 'PENDING',
                            'date': datetime
                            },
                      dataType:'json',
                      success: function(data)
                      {
                         // console.log(data);  
                         if(data=='EXPIRED SESSION')
                          {
                             Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                           
                             setTimeout(function() {
                               window.parent.location.href = "<?php echo base_url() ?>cfscashier_denomination_route";
                              }, 1000);
                          }
                          else
                          {
                               Swal.fire('Successfully Submit!', '', 'success')    
                          
                               setTimeout(function() {
                                window.parent.location.href = "<?php echo base_url() ?>cfscashier_denomination_route";
                              }, 1000);
                          }
                      }
                    });
                }
        }

      } else if (result.isDenied) {
        Swal.fire('Cancel Submit!', '', 'info')
      }
    })

  }

  function cfsforex_ercalculation_js()
  {
    var tfc1 = $('#tfc_fiveh').val().split(',').join('');
    var er1 = $('#er_fiveh').val().split(',').join('');
    var tfc2 = $('#tfc_twoh').val().split(',').join('');
    var er2 = $('#er_twoh').val().split(',').join('');
    var tfc3 = $('#tfc_oneh').val().split(',').join('');
    var er3 = $('#er_oneh').val().split(',').join('');
    var tfc4 = $('#tfc_fifty').val().split(',').join('');
    var er4 = $('#er_fifty').val().split(',').join('');
    var tfc5 = $('#tfc_twenty').val().split(',').join('');
    var er5 = $('#er_twenty').val().split(',').join('');
    var tfc6 = $('#tfc_ten').val().split(',').join('');
    var er6 = $('#er_ten').val().split(',').join('');
    var tfc7 = $('#tfc_five').val().split(',').join('');
    var er7 = $('#er_five').val().split(',').join('');
    var tfc8 = $('#tfc_two').val().split(',').join('');
    var er8 = $('#er_two').val().split(',').join('');
    var tfc9 = $('#tfc_one').val().split(',').join('');
    var er9 = $('#er_one').val().split(',').join('');

    res1 = tfc1 * er1;
    res2 = tfc2 * er2;
    res3 = tfc3 * er3;
    res4 = tfc4 * er4;
    res5 = tfc5 * er5;
    res6 = tfc6 * er6;
    res7 = tfc7 * er7;
    res8 = tfc8 * er8;
    res9 = tfc9 * er9;

    $('#pa_fiveh').val(res1.toLocaleString());
    $('#pa_twoh').val(res2.toLocaleString());
    $('#pa_oneh').val(res3.toLocaleString());
    $('#pa_fifty').val(res4.toLocaleString());
    $('#pa_twenty').val(res5.toLocaleString());
    $('#pa_ten').val(res6.toLocaleString());
    $('#pa_five').val(res7.toLocaleString());
    $('#pa_two').val(res8.toLocaleString());
    $('#pa_one').val(res9.toLocaleString());
    // console.log(res);
   
    var amount13 = parseFloat(res1) + 
                   parseFloat(res2) + 
                   parseFloat(res3) + 
                   parseFloat(res4) + 
                   parseFloat(res5) + 
                   parseFloat(res6) + 
                   parseFloat(res7) + 
                   parseFloat(res8) + 
                   parseFloat(res9) ;

    //   ====================TOTAL=====================================
    $('#total_forex_peso').val(amount13.toLocaleString());
  }

  var forex_counter = 0;
  function forex_form_duplicate_js()
  {
    var div_id = forex_counter++;
    // console.log(div_id);
    var forex_form_counter = $("#forex_form_counter").val(); 

    var current_val = $("#cfsforex_counter").val(); 
    $("#cfsforex_counter").val(current_val+"_div"+div_id); 

    var currency = $("#cfs_forex_list").val();
    $.ajax({
                type:'post',
                url :'<?php echo base_url(); ?>forex_form_duplicate_route',
                data: {
                       'id': div_id,
                       'forex_form_counter':forex_form_counter,
                       'currency':currency
                      },
                dataType:'json',
                success: function(data)
                { 
                  // console.log(data.html);                           
                  $(".cfsforex_add").append(data.html);
                  $("#forex_form_counter").val(data.forex_form_counter_last);
                }

            })
  }

  function forex_form_remove_div_js()
  {
    var div = $("#cfsforex_counter").val().split("_");

    var my_array = div;/* some array here */
    var last_element = my_array[my_array.length - 1];

    $("#"+last_element).remove();

    var cfsforex_counter =$("#cfsforex_counter").val();
    cfsforex_counter_ = cfsforex_counter.replace('_'+last_element, '');
    $("#cfsforex_counter").val(cfsforex_counter_);

    var forex_form_counter = $("#forex_form_counter").val();
    if(forex_form_counter==21)
    {
     $("#forex_form_counter").val(forex_form_counter);   
    }
    else
    {
     forex_form_counter2 = forex_form_counter-21;
     $("#forex_form_counter").val(forex_form_counter2);  
    }
  }

  function reset_forex_denomination_js()
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

          window.parent.location.href = "<?php echo base_url() ?>cfs_forex_denomination_route"; 
       
        } else if (result.isDenied) {
          Swal.fire('CANCELLED', '', 'info')
        }
      })
  }

  function submit_forex_denomination_js()
  {

    if(($(".tfc_fiveh").val() != '0' && $(".pa_fiveh").val() == '0') || ($(".tfc_twoh").val() != '0' && $(".pa_twoh").val() == '0') || ($(".tfc_oneh").val() != '0' && $(".pa_oneh").val() == '0') || ($(".tfc_fifty").val() != '0' && $(".pa_fifty").val() == '0') || ($(".tfc_twenty").val() != '0' && $(".pa_twenty").val() == '0') || ($(".tfc_ten").val() != '0' && $(".pa_ten").val() == '0') || ($(".tfc_five").val() != '0' && $(".pa_five").val() == '0') || ($(".tfc_two").val() != '0' && $(".pa_two").val() == '0') || ($(".tfc_one").val() != '0' && $(".pa_one").val() == '0'))
    {
      Swal.fire('Missing Data', 'Please check your Quantity and Exchange Rate', 'error')
    }
    else
    {
      Swal.fire({
        title: 'Are you sure you want to submit?',
        text: 'Please check your denomination first before submit',
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

          var tot = $('#total_forex_peso').val();
          var tot2 = tot.split(',').join('');
           
           if(tot == '' || tot == '0')
           {
             Swal.fire('Missing Data', 'Total must not be empty or 0!', 'error')
           } 
           else
           {
                 var forex_form_counter_last = $("#forex_form_counter").val(); 
                 var trno = $("#forex_trno").val();
                 var tr_no = ('0000000000' + trno).slice(-10);

                 var form_entry =0;
                 var datas = '';
                 var dup   = [];

                 for(var a=0;a<parseInt(forex_form_counter_last);a++)
                 {
                    var total = $(".val"+a).val(); 
                   
                    if(form_entry == 19)
                    {
                        total = $(".val"+a).val().split(',').join('');
                       
                        if(total == '' || total == '0')
                        {
                          Swal.fire('Missing Data', 'Total must not be empty or 0!', 'error')
                          return;
                        }
                    }

                    if(form_entry == 20)
                    {
                        var forex = $(".val"+a).val();

                        if(dup.includes(forex))
                        {
                          Swal.fire('DUPLICATE: '+forex, 'Please check your currency before submit', 'error')
                          return;
                        } 
                        else 
                        {
                          dup.push(forex);
                        }

                    }

                     datas =datas+"_"+total;

                     form_entry+=1;

                     if(form_entry==21)
                     {
                      datas = datas+'^';
                      form_entry =0;
                     }

                 } 
                 
                 datas = datas.split("^");           

                 for(var b=0;b<datas.length-1;b++)
                 { 
                     $.ajax({
                        type:'post',
                        url: '<?php echo base_url(); ?>submit_forex_denomination_route',
                        data:{'datas': datas[b],
                              'tr_no': tr_no
                              },
                        dataType:'json',
                        success: function(data)
                        {
                           if(data=='EXPIRED SESSION')
                            {
                               Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                             
                               setTimeout(function() {
                                 window.parent.location.href = "<?php echo base_url() ?>cfs_forex_denomination_route";
                                }, 1000);
                            }
                            else
                            {
                                 Swal.fire('Successfully Submit!', '', 'success')    
                            
                                 setTimeout(function() {
                                  window.parent.location.href = "<?php echo base_url() ?>cfs_forex_denomination_route";
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

  function get_pending_cash_js()
  {
    $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>get_pending_cash_route',
          dataType:'json',
          success: function(data)
          { 
             // console.log(data.html);                           
             $("#cfscash_history_form").html(data.html);
          }
      })
  }

  function get_pending_noncash_js()
  {
    $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>get_pending_noncash_route',
          dataType:'json',
          success: function(data)
          { 
             // console.log(data.html);                           
             $("#cfsnoncash_history_form").html(data.html);
          }
      })
  }

  function cfs_cash_history_js(id)
  {
/*=========================================AUTO COMPUTE========================================================*/
    $(function() {
        var res = $("#q_onek"+id).val() * 1000;
        var res1 = $("#q_fiveh"+id).val() * 500;
        var res2 = $("#q_twoh"+id).val() * 200;
        var res3 = $("#q_oneh"+id).val() * 100;
        var res4 = $("#q_fifty"+id).val() * 50;
        var res5 = $("#q_twenty"+id).val() * 20;
        var res6 = $("#q_ten"+id).val() * 10;
        var res7 = $("#q_five"+id).val() * 5;
        var res8 = $("#q_one"+id).val() * 1;
        var res9 = $("#q_twentyfivecents"+id).val() * 0.25;
        var res10 = $("#q_tencents"+id).val() * 0.10;
        var res11 = $("#q_fivecents"+id).val() * 0.05;
        var res12 = $("#q_onecents"+id).val() * 0.01;
         
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

          $("#a_onek"+id).val(amount.toLocaleString());
          $("#a_fiveh"+id).val(amount1.toLocaleString());
          $("#a_twoh"+id).val(amount2.toLocaleString());
          $("#a_oneh"+id).val(amount3.toLocaleString());
          $("#a_fifty"+id).val(amount4.toLocaleString());
          $("#a_twenty"+id).val(amount5.toLocaleString());
          $("#a_ten"+id).val(amount6.toLocaleString());
          $("#a_five"+id).val(amount7.toLocaleString());
          $("#a_one"+id).val(amount8.toLocaleString());
          $("#a_twentyfivecents"+id).val(amount9.toLocaleString());
          $("#a_tencents"+id).val(amount10.toLocaleString());
          $("#a_fivecents"+id).val(amount11.toLocaleString());
          $("#a_onecents"+id).val(amount12.toLocaleString());

          $("#total_cash"+id).val(amount13.toLocaleString());
      });
/*=======================================================================================================================*/


/*======================================VALIDATE WHOLE NUMBER ONLY===============================================*/
    document.querySelector("#q_onek"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
    });

     document.querySelector("#q_fiveh"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
    });

     document.querySelector("#q_twoh"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
    });

     document.querySelector("#q_oneh"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
    });

     document.querySelector("#q_fifty"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
    });

     document.querySelector("#q_twenty"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
    });

     document.querySelector("#q_ten"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
    });

     document.querySelector("#q_five"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
    });

     document.querySelector("#q_one"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
    });

     document.querySelector("#q_twentyfivecents"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
    });

     document.querySelector("#q_tencents"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
    });

     document.querySelector("#q_fivecents"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
    });

     document.querySelector("#q_onecents"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
    });
  }

  function cfs_update_cash_history_js(id)
  {
    Swal.fire({
      title: 'Are you sure you want to update?',
      text: 'Please check your denomination first before update',
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

        var tot = $('#total_cash'+id).val();
        var tot2 = tot.split(',').join('');
        var selected_id = id;

         if(tot == '' || tot == '0')
         {
           Swal.fire('Missing Data', 'Total must not be empty or 0!', 'error')
         } 
         else
         {
           // console.log($('#cfs_cashmop'+id).val()); 
           $.ajax({
              type:'post',
              url: '<?php echo base_url(); ?>cfs_update_cash_history_route',
              data:{'cash_type': $('#cfs_cashmop'+id).val(),
                    'onek': $('#q_onek'+id).val(),
                    'fiveh': $('#q_fiveh'+id).val(),
                    'twoh': $('#q_twoh'+id).val(),
                    'oneh': $('#q_oneh'+id).val(),
                    'fifty': $('#q_fifty'+id).val(),
                    'twenty': $('#q_twenty'+id).val(),
                    'ten': $('#q_ten'+id).val(),
                    'five': $('#q_five'+id).val(),
                    'one': $('#q_one'+id).val(),
                    'twentyfive_cents': $('#q_twentyfivecents'+id).val(),
                    'ten_cents': $('#q_tencents'+id).val(),
                    'five_cents': $('#q_fivecents'+id).val(),
                    'one_cents': $('#q_onecents'+id).val(),
                    'total_cash': tot2,
                    'id': selected_id
                    },
              dataType:'json',
              success: function(data)
              {
                 // console.log(data);  
                 if(data == 'EXPIRED SESSION')
                  {
                     Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                   
                     setTimeout(function() {
                       window.parent.location.href = "<?php echo base_url() ?>cfs_history_denomination_route";
                      }, 1000);
                  }
                  else if(data == 'OKAY')
                  {
                    Swal.fire('Successfully Update!', '', 'success');    
                  
                       setTimeout(function() {
                        window.parent.location.href = "<?php echo base_url() ?>cfs_history_denomination_route";
                      }, 1000);
                  }
                  else
                  {
                    Swal.fire('DUPLICATE: '+data, 'Please check your cash type before submit', 'error');
                    return; 
                  }
              }
            });
        }

      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
  }

  function cfs_reset_history_js()
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

          window.parent.location.href = "<?php echo base_url() ?>cfs_history_denomination_route"; 
       
        } else if (result.isDenied) {
          Swal.fire('CANCELLED', '', 'info')
        }
      })
  }

  function cfs_update_noncash_history_js(id)
  {
    Swal.fire({
      title: 'Are you sure you want to update?',
      text: 'Please check your denomination first before update',
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

        var amount = $('#cfs_noncash_amount'+id).val();
        var amount2 = amount.split(',').join('');
        var selected_id = id;

         if(amount == '' || amount == 0.00)
         {
           Swal.fire('Missing Data', 'Amount must not be empty or 0!', 'error');
         }
         else if($("#cfs_noncash_cheqno"+id).val() == '' || $("#cfs_noncash_cheqno"+id).val() == '0')
         {
          Swal.fire('Missing Data', 'Cheque no. must not be empty or 0!', 'error');
         } 
         else
         {
              
           $.ajax({
              type:'post',
              url: '<?php echo base_url(); ?>cfs_update_noncash_history_route',
              data:{'noncash_type': $('#cfs_ncashmop'+id).val(),
                    'bank_name': $('#cfs_ncash_bankname'+id).val(),
                    'cheq_no': $('#cfs_noncash_cheqno'+id).val(),
                    'amount': amount2,
                    'id': selected_id
                    },
              dataType:'json',
              success: function(data)
              {
                 // console.log(data);  
                 if(data=='EXPIRED SESSION')
                  {
                     Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
                   
                     setTimeout(function() {
                       window.parent.location.href = "<?php echo base_url() ?>cfs_history_denomination_route";
                      }, 1000);
                  }
                  else
                  {
                       Swal.fire('Successfully Update!', '', 'success')    
                  
                       setTimeout(function() {
                        window.parent.location.href = "<?php echo base_url() ?>cfs_history_denomination_route";
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

  function get_pending_forex_js()
  {
    $.ajax({
          type:'post',
          url :'<?php echo base_url(); ?>get_pending_forex_route',
          dataType:'json',
          success: function(data)
          { 
             // console.log(data.html);                           
             $("#divbody_cfsforex_history_denominationform").html(data.html);
          }
      })
  }

  function history_change_currency_js(id,tr_no)
  {
    // console.log(id,tr_no);
    var currency = $("#cfs_forex_list"+id).val();
    $.ajax({
        type:"post",
        // url :"'.base_url().'change_currency_route",
        url :"<?php echo base_url(); ?>history_change_currency_route",
        data:{"currency":currency,
              "id":id,
              "tr_no":tr_no
            },
        dataType:"json",
        success: function(data)
        {                   
           $("#cfscashier_forextbody"+id).html(data.html)
        }

      })
  }

  function history_tfccalculation_js(id)
  {
    // console.log(id);
    var res1 = $('#hq_fiveh'+id).val() * 500;
    var res2 = $('#hq_twoh'+id).val() * 200;
    var res3 = $('#hq_oneh'+id).val() * 100;
    var res4 = $('#hq_fifty'+id).val() * 50;
    var res5 = $('#hq_twenty'+id).val() * 20;
    var res6 = $('#hq_ten'+id).val() * 10;
    var res7 = $('#hq_five'+id).val() * 5;
    var res8 = $('#hq_two'+id).val() * 2;
    var res9 = $('#hq_one'+id).val() * 1;
   
    var amount1 = res1;
    var amount2 = res2;
    var amount3 = res3;
    var amount4 = res4;
    var amount5 = res5;
    var amount6 = res6;
    var amount7 = res7;
    var amount8 = res8;
    var amount9 = res9;

    var amount13 = parseFloat(amount1) + 
                   parseFloat(amount2) + 
                   parseFloat(amount3) + 
                   parseFloat(amount4) + 
                   parseFloat(amount5) + 
                   parseFloat(amount6) + 
                   parseFloat(amount7) + 
                   parseFloat(amount8) + 
                   parseFloat(amount9) ;

    $('#htfc_fiveh'+id).val(amount1.toLocaleString());
    $('#htfc_twoh'+id).val(amount2.toLocaleString());
    $('#htfc_oneh'+id).val(amount3.toLocaleString());
    $('#htfc_fifty'+id).val(amount4.toLocaleString());
    $('#htfc_twenty'+id).val(amount5.toLocaleString());
    $('#htfc_ten'+id).val(amount6.toLocaleString());
    $('#htfc_five'+id).val(amount7.toLocaleString());
    $('#htfc_two'+id).val(amount8.toLocaleString());
    $('#htfc_one'+id).val(amount9.toLocaleString());

    //   ====================TOTAL=====================================
    $('#htotal_forex_fc'+id).val(amount13.toLocaleString());

    var id2 = id;
    history_ercalculation_js(id2);
    history_disabled_spcharater_js(id2);
  }

  function history_ercalculation_js(id)
  {
    // console.log(id);
    var tfc1 = $('#htfc_fiveh'+id).val().split(',').join('');
    var er1 = $('#her_fiveh'+id).val().split(',').join('');
    var tfc2 = $('#htfc_twoh'+id).val().split(',').join('');
    var er2 = $('#her_twoh'+id).val().split(',').join('');
    var tfc3 = $('#htfc_oneh'+id).val().split(',').join('');
    var er3 = $('#her_oneh'+id).val().split(',').join('');
    var tfc4 = $('#htfc_fifty'+id).val().split(',').join('');
    var er4 = $('#her_fifty'+id).val().split(',').join('');
    var tfc5 = $('#htfc_twenty'+id).val().split(',').join('');
    var er5 = $('#her_twenty'+id).val().split(',').join('');
    var tfc6 = $('#htfc_ten'+id).val().split(',').join('');
    var er6 = $('#her_ten'+id).val().split(',').join('');
    var tfc7 = $('#htfc_five'+id).val().split(',').join('');
    var er7 = $('#her_five'+id).val().split(',').join('');
    var tfc8 = $('#htfc_two'+id).val().split(',').join('');
    var er8 = $('#her_two'+id).val().split(',').join('');
    var tfc9 = $('#htfc_one'+id).val().split(',').join('');
    var er9 = $('#her_one'+id).val().split(',').join('');

    res1 = tfc1 * er1;
    res2 = tfc2 * er2;
    res3 = tfc3 * er3;
    res4 = tfc4 * er4;
    res5 = tfc5 * er5;
    res6 = tfc6 * er6;
    res7 = tfc7 * er7;
    res8 = tfc8 * er8;
    res9 = tfc9 * er9;

    $('#hpa_fiveh'+id).val(res1.toLocaleString());
    $('#hpa_twoh'+id).val(res2.toLocaleString());
    $('#hpa_oneh'+id).val(res3.toLocaleString());
    $('#hpa_fifty'+id).val(res4.toLocaleString());
    $('#hpa_twenty'+id).val(res5.toLocaleString());
    $('#hpa_ten'+id).val(res6.toLocaleString());
    $('#hpa_five'+id).val(res7.toLocaleString());
    $('#hpa_two'+id).val(res8.toLocaleString());
    $('#hpa_one'+id).val(res9.toLocaleString());
    // console.log(res);
   
    var amount13 = parseFloat(res1) + 
                   parseFloat(res2) + 
                   parseFloat(res3) + 
                   parseFloat(res4) + 
                   parseFloat(res5) + 
                   parseFloat(res6) + 
                   parseFloat(res7) + 
                   parseFloat(res8) + 
                   parseFloat(res9) ;

    //   ====================TOTAL=====================================
    $('#htotal_forex_peso'+id).val(amount13.toLocaleString());
  }

 function history_disabled_spcharater_js(id)
 {
      /*$("#submit_cfsforexden").click(function() {
        if(($("#tfc_fiveh"+id).val() != '0' && $("#pa_fiveh"+id).val() == '0') || ($("#tfc_twoh"+id).val() != '0' && $("#pa_twoh"+id).val() == '0') || ($("#tfc_oneh"+id).val() != '0' && $("#pa_oneh"+id).val() == '0') || ($("#tfc_fifty"+id).val() != '0' && $("#pa_fifty"+id).val() == '0') || ($("#tfc_twenty"+id).val() != '0' && $("#pa_twenty"+id).val() == '0') || ($("#tfc_ten"+id).val() != '0' && $("#pa_ten"+id).val() == '0') || ($("#tfc_five"+id).val() != '0' && $("#pa_five"+id).val() == '0') || ($("#tfc_two"+id).val() != '0' && $("#pa_two"+id).val() == '0') || ($("#tfc_one"+id).val() != '0' && $("#pa_one"+id).val() == '0'))
          {
            Swal.fire('Missing Data', 'Please check your Quantity and Exchange Rate', 'error')
          }
      });*/


      if($("#htfc_fiveh"+id).val() != '0')
      {
        document.getElementById("her_fiveh"+id).disabled = false;
      }
      else
      {
        document.getElementById("her_fiveh"+id).disabled = true;
        document.getElementById("her_fiveh"+id).value = '0';
      }

      if( $("#htfc_twoh"+id).val() != '0')
      {
        document.getElementById("her_twoh"+id).disabled = false;
      }
      else
      {
        document.getElementById("her_twoh"+id).disabled = true;
        document.getElementById("her_twoh"+id).value = '0';
      }

      if( $("#htfc_oneh"+id).val() != '0')
      {
        document.getElementById("her_oneh"+id).disabled = false;
      }
      else
      {
        document.getElementById("her_oneh"+id).disabled = true;
        document.getElementById("her_oneh"+id).value = '0';
      }

      if( $("#htfc_fifty"+id).val() != '0')
      {
        document.getElementById("her_fifty"+id).disabled = false;
      }
      else
      {
        document.getElementById("her_fifty"+id).disabled = true;
        document.getElementById("her_fifty"+id).value = '0';
      }

      if( $("#htfc_twenty"+id).val() != '0')
      {
        document.getElementById("her_twenty"+id).disabled = false;
      }
      else
      {
        document.getElementById("her_twenty"+id).disabled = true;
        document.getElementById("her_twenty"+id).value = '0';
      }

      if( $("#htfc_ten"+id).val() != '0')
      {
        document.getElementById("her_ten"+id).disabled = false;
      }
      else
      {
        document.getElementById("her_ten"+id).disabled = true;
        document.getElementById("her_ten"+id).value = '0';
      }

      if( $("#htfc_five"+id).val() != '0')
      {
        document.getElementById("her_five"+id).disabled = false;
      }
      else
      {
        document.getElementById("her_five"+id).disabled = true;
        document.getElementById("her_five"+id).value = '0';
      }

      if( $("#htfc_two"+id).val() != '0')
      {
        document.getElementById("her_two"+id).disabled = false;
      }
      else
      {
        document.getElementById("her_two"+id).disabled = true;
        document.getElementById("her_two"+id).value = '0';
      }

      if( $("#htfc_one"+id).val() != '0')
      {
        document.getElementById("her_one"+id).disabled = false;
      }
      else
      {
        document.getElementById("her_one"+id).disabled = true;
        document.getElementById("her_one"+id).value = '0';
      }



      document.querySelector("#hq_fiveh"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
        });

      document.querySelector("#hq_twoh"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
        });

      document.querySelector("#hq_oneh"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
        });

      document.querySelector("#hq_fifty"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
        });

      document.querySelector("#hq_twenty"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
        });

      document.querySelector("#hq_ten"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
        });

      document.querySelector("#hq_five"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
        });

      document.querySelector("#hq_two"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
        });

      document.querySelector("#hq_one"+id).addEventListener("keypress", function (evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
        });
 }

 function history_disabled_exchange_rate_js(id)
 {
    if($("#htfc_fiveh"+id).val() != '0')
    {
      document.getElementById("her_fiveh"+id).disabled = false;
    }
    else
    {
      document.getElementById("her_fiveh"+id).disabled = true;
    }

    if($("#htfc_twoh"+id).val() != '0')
    {
      document.getElementById("her_twoh"+id).disabled = false;
    }
    else
    {
      document.getElementById("her_twoh"+id).disabled = true;
    }

    if($("#htfc_oneh"+id).val() != '0')
    {
      document.getElementById("her_oneh"+id).disabled = false;
    }
    else
    {
      document.getElementById("her_oneh"+id).disabled = true;
    }

    if($("#htfc_fifty"+id).val() != '0')
    {
      document.getElementById("her_fifty"+id).disabled = false;
    }
    else
    {
      document.getElementById("her_fifty"+id).disabled = true;
    }

    if($("#htfc_twenty"+id).val() != '0')
    {
      document.getElementById("her_twenty"+id).disabled = false;
    }
    else
    {
      document.getElementById("her_twenty"+id).disabled = true;
    }

    if($("#htfc_ten"+id).val() != '0')
    {
      document.getElementById("her_ten"+id).disabled = false;
    }
    else
    {
      document.getElementById("her_ten"+id).disabled = true;
    }

    if($("#htfc_five"+id).val() != '0')
    {
      document.getElementById("her_five"+id).disabled = false;
    }
    else
    {
      document.getElementById("her_five"+id).disabled = true;
    }

    if($("#htfc_two"+id).val() != '0')
    {
      document.getElementById("her_two"+id).disabled = false;
    }
    else
    {
      document.getElementById("her_two"+id).disabled = true;
    }

    if($("#htfc_one"+id).val() != '0')
    {
      document.getElementById("her_one"+id).disabled = false;
    }
    else
    {
      document.getElementById("her_one"+id).disabled = true;
    }
 }

 function update_forex_denomination_js(id,tr_no)
 {
  // console.log(id,tr_no);
  Swal.fire({
      title: 'Are you sure you want to update?',
      text: 'Please check your forex denomination first before update',
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

        var tot_fc = $('#htotal_forex_fc'+id).val();
        var tot_fc2 = tot_fc.split(',').join('');

        var tot_peso = $('#htotal_forex_peso'+id).val();
        var tot_peso2 = tot_peso.split(',').join('');
        var selected_id = id;
        var selected_trno = tr_no;

         if(tot_peso == '' || tot_peso == '0')
         {
           Swal.fire('Missing Data', 'Total Peso Amount must not be empty or 0!', 'error');
           return;
         } 
         else
         {
           // console.log($('#cfs_cashmop'+id).val()); 
           $.ajax({
              type:'post',
              url: '<?php echo base_url(); ?>update_forex_denomination_route',
              data:{'currency': $('#cfs_forex_list'+id).val(),
                    'q_fiveh': $('#hq_fiveh'+id).val(),
                    'q_twoh': $('#hq_twoh'+id).val(),
                    'q_oneh': $('#hq_oneh'+id).val(),
                    'q_fifty': $('#hq_fifty'+id).val(),
                    'q_twenty': $('#hq_twenty'+id).val(),
                    'q_ten': $('#hq_ten'+id).val(),
                    'q_five': $('#hq_five'+id).val(),
                    'q_two': $('#hq_two'+id).val(),
                    'q_one': $('#hq_one'+id).val(),
                    'total_fc': tot_fc2,
                    'er_fiveh': $('#her_fiveh'+id).val(),
                    'er_twoh': $('#her_twoh'+id).val(),
                    'er_oneh': $('#her_oneh'+id).val(),
                    'er_fifty': $('#her_fifty'+id).val(),
                    'er_twenty': $('#her_twenty'+id).val(),
                    'er_ten': $('#her_ten'+id).val(),
                    'er_five': $('#her_five'+id).val(),
                    'er_two': $('#her_two'+id).val(),
                    'er_one': $('#her_one'+id).val(),
                    'total_peso': tot_peso2,
                    'id': selected_id,
                    'tr_no': selected_trno
                    },
              dataType:'json',
              success: function(data)
              {
                 // console.log(data);  
                 if(data == 'EXPIRED SESSION')
                  {
                     Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error');
                   
                     setTimeout(function() {
                       window.parent.location.href = "<?php echo base_url() ?>cfs_history_denomination_route";
                      }, 1000);
                  }
                  else if(data == 'OKAY')
                  {
                    Swal.fire('Successfully Update!', '', 'success');    
                  
                       setTimeout(function() {
                        window.parent.location.href = "<?php echo base_url() ?>cfs_history_denomination_route";
                      }, 1000);
                  }
                  else
                  {
                    Swal.fire('DUPLICATE: '+data, 'Please check your currency before submit', 'error');
                    return; 
                  }
              }
            });
        }

      } else if (result.isDenied) {
        Swal.fire('CANCELLED', '', 'info')
      }
    })
 }

</script>