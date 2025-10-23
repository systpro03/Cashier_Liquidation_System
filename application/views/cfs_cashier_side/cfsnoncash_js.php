


<!-- ==============================plugins in maskmoney=============================================================================== -->
<script src="<?php echo base_url();?>assets/src/jquery.maskMoney.js" type="text/javascript"></script>

<script type="text/javascript">
	
	function duplicate_tfccalculation_js(id)
	  {
	  	// console.log(id);
	    var res1 = $('#q_fiveh'+id).val() * 500;
	    var res2 = $('#q_twoh'+id).val() * 200;
	    var res3 = $('#q_oneh'+id).val() * 100;
	    var res4 = $('#q_fifty'+id).val() * 50;
	    var res5 = $('#q_twenty'+id).val() * 20;
	    var res6 = $('#q_ten'+id).val() * 10;
	    var res7 = $('#q_five'+id).val() * 5;
	    var res8 = $('#q_two'+id).val() * 2;
	    var res9 = $('#q_one'+id).val() * 1;
	   
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

	    $('#tfc_fiveh'+id).val(amount1.toLocaleString());
	    $('#tfc_twoh'+id).val(amount2.toLocaleString());
	    $('#tfc_oneh'+id).val(amount3.toLocaleString());
	    $('#tfc_fifty'+id).val(amount4.toLocaleString());
	    $('#tfc_twenty'+id).val(amount5.toLocaleString());
	    $('#tfc_ten'+id).val(amount6.toLocaleString());
	    $('#tfc_five'+id).val(amount7.toLocaleString());
	    $('#tfc_two'+id).val(amount8.toLocaleString());
	    $('#tfc_one'+id).val(amount9.toLocaleString());

	    //   ====================TOTAL=====================================
	    $('#total_forex_fc'+id).val(amount13.toLocaleString());

	    var id2 = id;
	    duplicate_ercalculation_js(id2);
	    disabled_spcharater_js(id2);
	  }

	 function disabled_spcharater_js(id)
	 {
	 
			  $("#submit_cfsforexden").click(function() {
				  if(($("#tfc_fiveh"+id).val() != '0' && $("#pa_fiveh"+id).val() == '0') || ($("#tfc_twoh"+id).val() != '0' && $("#pa_twoh"+id).val() == '0') || ($("#tfc_oneh"+id).val() != '0' && $("#pa_oneh"+id).val() == '0') || ($("#tfc_fifty"+id).val() != '0' && $("#pa_fifty"+id).val() == '0') || ($("#tfc_twenty"+id).val() != '0' && $("#pa_twenty"+id).val() == '0') || ($("#tfc_ten"+id).val() != '0' && $("#pa_ten"+id).val() == '0') || ($("#tfc_five"+id).val() != '0' && $("#pa_five"+id).val() == '0') || ($("#tfc_two"+id).val() != '0' && $("#pa_two"+id).val() == '0') || ($("#tfc_one"+id).val() != '0' && $("#pa_one"+id).val() == '0'))
				    {
				      Swal.fire('Missing Data', 'Please check your Quantity and Exchange Rate', 'error')
				    }
				});


	 			if($("#tfc_fiveh"+id).val() != '0')
		    {
		      document.getElementById("er_fiveh"+id).disabled = false;
		    }
		    else
		    {
		      document.getElementById("er_fiveh"+id).disabled = true;
		      document.getElementById("er_fiveh"+id).value = '0';
		    }

		    if( $("#tfc_twoh"+id).val() != '0')
		    {
		      document.getElementById("er_twoh"+id).disabled = false;
		    }
		    else
		    {
		      document.getElementById("er_twoh"+id).disabled = true;
		      document.getElementById("er_twoh"+id).value = '0';
		    }

		    if( $("#tfc_oneh"+id).val() != '0')
		    {
		      document.getElementById("er_oneh"+id).disabled = false;
		    }
		    else
		    {
		      document.getElementById("er_oneh"+id).disabled = true;
		      document.getElementById("er_oneh"+id).value = '0';
		    }

		    if( $("#tfc_fifty"+id).val() != '0')
		    {
		      document.getElementById("er_fifty"+id).disabled = false;
		    }
		    else
		    {
		      document.getElementById("er_fifty"+id).disabled = true;
		      document.getElementById("er_fifty"+id).value = '0';
		    }

		    if( $("#tfc_twenty"+id).val() != '0')
		    {
		      document.getElementById("er_twenty"+id).disabled = false;
		    }
		    else
		    {
		      document.getElementById("er_twenty"+id).disabled = true;
		      document.getElementById("er_twenty"+id).value = '0';
		    }

		    if( $("#tfc_ten"+id).val() != '0')
		    {
		      document.getElementById("er_ten"+id).disabled = false;
		    }
		    else
		    {
		      document.getElementById("er_ten"+id).disabled = true;
		      document.getElementById("er_ten"+id).value = '0';
		    }

		    if( $("#tfc_five"+id).val() != '0')
		    {
		      document.getElementById("er_five"+id).disabled = false;
		    }
		    else
		    {
		      document.getElementById("er_five"+id).disabled = true;
		      document.getElementById("er_five"+id).value = '0';
		    }

		    if( $("#tfc_two"+id).val() != '0')
		    {
		      document.getElementById("er_two"+id).disabled = false;
		    }
		    else
		    {
		      document.getElementById("er_two"+id).disabled = true;
		      document.getElementById("er_two"+id).value = '0';
		    }

		    if( $("#tfc_one"+id).val() != '0')
		    {
		      document.getElementById("er_one"+id).disabled = false;
		    }
		    else
		    {
		      document.getElementById("er_one"+id).disabled = true;
		      document.getElementById("er_one"+id).value = '0';
		    }



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

        document.querySelector("#q_two"+id).addEventListener("keypress", function (evt) {
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
	 }

	 function duplicate_ercalculation_js(id)
	  {
	  	// console.log(id);
	    var tfc1 = $('#tfc_fiveh'+id).val().split(',').join('');
	    var er1 = $('#er_fiveh'+id).val().split(',').join('');
	    var tfc2 = $('#tfc_twoh'+id).val().split(',').join('');
	    var er2 = $('#er_twoh'+id).val().split(',').join('');
	    var tfc3 = $('#tfc_oneh'+id).val().split(',').join('');
	    var er3 = $('#er_oneh'+id).val().split(',').join('');
	    var tfc4 = $('#tfc_fifty'+id).val().split(',').join('');
	    var er4 = $('#er_fifty'+id).val().split(',').join('');
	    var tfc5 = $('#tfc_twenty'+id).val().split(',').join('');
	    var er5 = $('#er_twenty'+id).val().split(',').join('');
	    var tfc6 = $('#tfc_ten'+id).val().split(',').join('');
	    var er6 = $('#er_ten'+id).val().split(',').join('');
	    var tfc7 = $('#tfc_five'+id).val().split(',').join('');
	    var er7 = $('#er_five'+id).val().split(',').join('');
	    var tfc8 = $('#tfc_two'+id).val().split(',').join('');
	    var er8 = $('#er_two'+id).val().split(',').join('');
	    var tfc9 = $('#tfc_one'+id).val().split(',').join('');
	    var er9 = $('#er_one'+id).val().split(',').join('');

	    res1 = tfc1 * er1;
	    res2 = tfc2 * er2;
	    res3 = tfc3 * er3;
	    res4 = tfc4 * er4;
	    res5 = tfc5 * er5;
	    res6 = tfc6 * er6;
	    res7 = tfc7 * er7;
	    res8 = tfc8 * er8;
	    res9 = tfc9 * er9;

	    $('#pa_fiveh'+id).val(res1.toLocaleString());
	    $('#pa_twoh'+id).val(res2.toLocaleString());
	    $('#pa_oneh'+id).val(res3.toLocaleString());
	    $('#pa_fifty'+id).val(res4.toLocaleString());
	    $('#pa_twenty'+id).val(res5.toLocaleString());
	    $('#pa_ten'+id).val(res6.toLocaleString());
	    $('#pa_five'+id).val(res7.toLocaleString());
	    $('#pa_two'+id).val(res8.toLocaleString());
	    $('#pa_one'+id).val(res9.toLocaleString());
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
	    $('#total_forex_peso'+id).val(amount13.toLocaleString());
	  }

	function change_currency_js(id, counter)
	  {
	    var currency = $("#cfs_forex_list"+id).val();
			$.ajax({
		      type:"post",
		      // url :"'.base_url().'change_currency_route",
		      url :"<?php echo base_url(); ?>change_currency_route",
		      data:{"currency":currency,
		          	"counter":counter,
		          	"id":id
		          },
		      dataType:"json",
		      success: function(data)
		      {                   
		         $("#cfscashier_forextbody"+id).html(data.html)
		      }

		  	})
	  }
	  

	/*======================================auto comma in number=================================================================*/
	$(".cfsncash_d_amount").maskMoney({thousands:',', decimal:'.', allowZero: true, suffix: ' '});
	$(".er_amount").maskMoney({thousands:',', decimal:'.', allowZero: true, suffix: ' '}).attr('maxlength', 7);
	/*=============================================================================================================================*/


	/*===========================================DISABLED EXCHANGE RATE INPUT BOX==================================================*/
	if($("#tfc_fiveh").val() != '0')
  {
    document.getElementById("er_fiveh").disabled = false;
  }
  else
  {
    document.getElementById("er_fiveh").disabled = true;
  }

  if($("#tfc_twoh").val() != '0')
  {
    document.getElementById("er_twoh").disabled = false;
  }
  else
  {
    document.getElementById("er_twoh").disabled = true;
  }

  if($("#tfc_oneh").val() != '0')
  {
    document.getElementById("er_oneh").disabled = false;
  }
  else
  {
    document.getElementById("er_oneh").disabled = true;
  }

  if($("#tfc_fifty").val() != '0')
  {
    document.getElementById("er_fifty").disabled = false;
  }
  else
  {
    document.getElementById("er_fifty").disabled = true;
  }

  if($("#tfc_twenty").val() != '0')
  {
    document.getElementById("er_twenty").disabled = false;
  }
  else
  {
    document.getElementById("er_twenty").disabled = true;
  }

  if($("#tfc_ten").val() != '0')
  {
    document.getElementById("er_ten").disabled = false;
  }
  else
  {
    document.getElementById("er_ten").disabled = true;
  }

  if($("#tfc_five").val() != '0')
  {
    document.getElementById("er_five").disabled = false;
  }
  else
  {
    document.getElementById("er_five").disabled = true;
  }

  if($("#tfc_two").val() != '0')
  {
    document.getElementById("er_two").disabled = false;
  }
  else
  {
    document.getElementById("er_two").disabled = true;
  }

  if($("#tfc_one").val() != '0')
  {
    document.getElementById("er_one").disabled = false;
  }
  else
  {
    document.getElementById("er_one").disabled = true;
  }
/*==============================================================================================================================*/


</script>



