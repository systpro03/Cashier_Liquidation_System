<!-- swal alert -->
<script src="<?php echo base_url('assets/js/dataTables.fixedHeader.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2@11.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.min.js'); ?>"></script>


<script>
    
	function get_allbusinessunit_js()
    {
        $.ajax({
	        type: 'post',
	        url: '<?php echo base_url(); ?>get_allbusinessunit_route',
	        dataType: 'json',
	        success: function(data) {
	          // console.log(data.bunit);
	          $('#bunit_list').html(data.html);
	          get_bunit_code_js(); 
	        }
        });
    }

    function get_bunit_code_js()
    {
    	// console.log($("#bunit_list").val());
    	$.ajax({
	        type: 'post',
	        url: '<?php echo base_url(); ?>get_bunit_code_route',
	        data:{'bname': $("#bunit_list").val()},
	        dataType: 'json',
	        success: function(data) {
	          // console.log(data.bunit);
	          $('#bunit_code').val(data.bcode);
	          get_dept_name_js(); 
	        }
        });
    }

    function get_dept_name_js()
    {
    	// console.log($("#bunit_code").val());
    	$.ajax({
	        type: 'post',
	        url: '<?php echo base_url(); ?>get_dept_name_route',
	        data:{'bunit_code': $("#bunit_code").val()},
	        dataType: 'json',
	        success: function(data) {
	          // console.log(data.bunit);
	          $('#department_list').html(data.html);
	          get_dept_code_js(); 
	        }
        });
    }

    function get_dept_code_js()
    {
    	// console.log($("#bunit_code").val(),$("#department_list").val());
    	$.ajax({
	        type: 'post',
	        url: '<?php echo base_url(); ?>get_dept_code_route',
	        data:{'bunit_code': $("#bunit_code").val(),
	        	  'dept_name': $("#department_list").val()
	    		 },
	        dataType: 'json',
	        success: function(data) {
	          // console.log(data.bunit);
	          $('#dept_code').val(data.dcode);
	          // get_dept_code_js(); 
	        }
        });
    }

    function get_banks_js()
    {
    	$.ajax({
	        type: 'post',
	        url: '<?php echo base_url(); ?>get_banks_route',
	        dataType: 'json',
	        success: function(data) {
	          // console.log(data.bunit);
	           $('#bank_list').html(data.html);
	          // get_dept_code_js(); 
	        }
        });
    }

    function submit_bank_tagging_js()
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

	     
	         if($('#bank_acctno').val() == '' || $("#acct_name").val() == '')
	         {
	            Swal.fire('Missing Data', 'Bank Account No. and Account Name must not be empty!', 'error');
	         }
	         else
	         {
	          $.ajax({
	            type: 'post',
	            url: '<?php echo base_url(); ?>submit_bank_tagging_route',
	            data: {
	              'bunit_name': $('#bunit_list').val(),
	              'department_name': $('#department_list').val(),
	              'bunit_code': $('#bunit_code').val(),
	              'dept_code': $('#dept_code').val(),
	              'bank_name': $('#bank_list').val(),
	              'bank_acctno': $('#bank_acctno').val(),
	              'acct_name': $('#acct_name').val(),
	              'date_setup': datetime
	            },
	            dataType: 'json',
	            success: function(data) {
	              // console.log(data);

	              if(data=='EXPIRED SESSION')
	              {
	                 Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
	               
	                 setTimeout(function() {
	                   window.parent.location.href = "<?php echo base_url() ?>treasury_route";
	                  }, 1000);
	              }
	              else
	              {
	                   Swal.fire('Successfully Save!', '', 'success')    
	              
	                   setTimeout(function() {
	                    window.parent.location.href = "<?php echo base_url() ?>treasury_route";
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

    function reset_bank_tagging_js()
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

	        window.parent.location.href = "<?php echo base_url() ?>treasury_route"; 
	     
	      } else if (result.isDenied) {
	        Swal.fire('Cancel reset', '', 'info')
	      }
	    })
    }

    function get_setup_bank_js()
    {
    	$('#bank_tagging_tbody').html('');
	    $.ajax({
	            type: 'post',
	            url: '<?php echo base_url(); ?>get_setup_bank_route',
	            dataType: 'json',
	            success: function(data) {
	               // console.log(data.html);
	             $('#bank_tagging_tbody').html(data.html);
	             setup_bank_datatable();
	            }
	          });
    }

    function setup_bank_datatable()
    {
      /*sort datatable*/
	  $(document).ready(function() {
	    $('#bank_list_table').DataTable({
	      "columnDefs": 
	      [
	        { 'visible': false, 'targets': [0] },
	        {"className": "text-center", "targets": [6]}
	      ],
	      "order": [
	        [0, "desc"]
	      ] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
	    });
	  });
    }

    function delete_banksetup_js(id)
    {
    	 // console.log(id); 
    	Swal.fire({
	    title: 'Are you sure you want to delete?',
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
		            url: '<?php echo base_url(); ?>delete_banksetup_route',
		            data:{'id': id},
		            dataType: 'json',
		            success: function(data) {
		              
		              Swal.fire('Successfully Delete!', '', 'success')    
	              
	                   setTimeout(function() {
	                    window.parent.location.href = "<?php echo base_url() ?>treasury_route";
	                  }, 1000);

		            }
		          });
	     
	      } else if (result.isDenied) {
	        Swal.fire('Cancel delete', '', 'info')
	      }
	    })
    }

    function edit_banksetup_js(id)
    {
    	Swal.fire({
	    title: 'Are you sure you want to edit?',
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

	      	window.location.hash = '#treasury_preheader';

	      	$("#setup_bank_header").text('Edit Bank Set-up');
	      	document.getElementById('reset_banksetup_btn').style.display = 'none';
	    		document.getElementById('submit_banksetup_btn').style.display = 'none';
	      	
	      	document.getElementById('cancel_banksetup_btn').style.display = 'inline-block';
	    		document.getElementById('update_banksetup_btn').style.display = 'inline-block';

	    	var bank_id = id;
	    	get_selected_bank_js(bank_id)
	     
	      } else if (result.isDenied) {
	        Swal.fire('Cancel edit', '', 'info')
	      }
	    })
    }

    function get_selected_bank_js(id)
    {
    	// console.log(id);
    	$.ajax({
	            type: 'post',
	            url: '<?php echo base_url(); ?>get_selected_bank_route',
	            data:{'id': id},
	            dataType: 'json',
	            success: function(data) {
	            // console.log(data.dname);
	            document.getElementById('department').hidden = false;

	       			 $('#edited_id').val(data.edited_id);
	       			 $('#bunit_list').val(data.buname);
	             $('#department').val(data.dname);
	       			 $('#dept_code').val(data.dcode);
	       			 $('#bank_list').val(data.bankname);
	         		 $('#bank_acctno').val(data.acctno);
	       			 $('#acct_name').val(data.acctname);

	       			 document.getElementById('department_list').hidden = true;

	       			 document.getElementById('bunit_list').disabled = true;
	       			 document.getElementById('bank_list').disabled = true;
	            }
	          });
    }

    function update_bank_tagging_js()
    {
    	Swal.fire({
	    title: 'Are you sure you want to update?',
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
	     		// console.log($('#edited_id').val(),$('#bunit_list').val(),$('#department').val(),$('#dept_code').val(),$('#bank_list').val(),$('#bank_acctno').val(),$('#acct_name').val());
	      
         if($('#bank_acctno').val() == '' || $("#acct_name").val() == '')
         {
            Swal.fire('Missing Data', 'Bank Account No. and Account Name must not be empty!', 'error');
         }
         else
         {
		      	$.ajax({
		            type: 'post',
		            url: '<?php echo base_url(); ?>update_bank_tagging_route',
		            data:{'id': $('#edited_id').val()},
		            dataType: 'json',
		            success: function(data) {
		            // console.log(data.dname);
		       			  if(data=='EXPIRED SESSION')
		              {
		                 Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
		               
		                 setTimeout(function() {
		                   window.parent.location.href = "<?php echo base_url() ?>treasury_route";
		                  }, 1000);
		              }
		              else
		              {
		                   save_updated_banktagging_js();
		              }

		            }
		          });
	       }

	      } else if (result.isDenied) {
	        Swal.fire('Cancel update', '', 'info')
	      }
	    })
    }

    function save_updated_banktagging_js()
    {
    	// console.log($('#edited_id').val(),$('#bunit_list').val(),$('#department').val(),$('#dept_code').val(),$('#bank_list').val(),$('#bank_acctno').val(),$('#acct_name').val());
    	$.ajax({
		            type: 'post',
		            url: '<?php echo base_url(); ?>save_updated_banktagging_route',
		            data:{'id': $('#edited_id').val(),
		            			'buname': $('#bunit_list').val(),
		            			'dname': $('#department').val(),
		            			'dcode': $('#dept_code').val(),
		            			'bankname': $('#bank_list').val(),
		            			'acctno': $('#bank_acctno').val(),
		            			'acctname': $('#acct_name').val()
		          				},
		            dataType: 'json',
		            success: function(data) {
		              
		              Swal.fire('Successfully update!', '', 'success')    
	              
	                   setTimeout(function() {
	                    window.parent.location.href = "<?php echo base_url() ?>treasury_route";
	                  }, 1000);

		            }
		          });
    }

</script>