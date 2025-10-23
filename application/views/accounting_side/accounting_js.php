<!-- swal alert -->
<script src="<?php echo base_url('assets/js/dataTables.fixedHeader.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2@11.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.all.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sweetalert2.min.js'); ?>"></script>


<script>
    
	function view_navcls_variance_js()
    {
		$('#divbody_navcls_table').html('');
		$.ajax({
			type: 'post',
			url: '<?php echo base_url(); ?>view_navcls_variance_route',
			dataType: 'json',
			success: function(data) {
				if(data=='EXPIRED SESSION')
				{
					Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
					
					setTimeout(function() {
						window.parent.location.href = "<?php echo base_url() ?>accounting_dashboard_route";
					}, 1000);
				}
				else
				{
					$('#divbody_navcls_table').html(data.html);
					navcls_datatable();
				}
			}
		});
    }

	function get_hml_file_js()
	{
		var file_name = $('#txt_file').val();
		if(file_name == '')
		{
			Swal.fire('MISSING HTML', 'Please choose html file before click upload button.', 'error');
			return;
		}
		else
		{
			// var validExtensions = ['htm','html','HTML','HTM']; //array of valid extensions
			var validExtensions = ['txt','TXT']; //array of valid extensions
			var fileName = file_name;
			var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
			if ($.inArray(fileNameExt, validExtensions) == -1){
				Swal.fire('INVALID FILE', 'Please choose html file before click upload button.', 'error');
				return;
			}
			else
			{
				if(file_name.replace(/\s/g, '') === "")
				{
					$('#txt_file').focus();
				}
				else
				{
					var txt_data = new FormData();
					var input = $('#txt_file')[0];
					$.each(input.files, function(i, file)
					{
						txt_data.append('files[]', file);
					});
					
					$.ajax({
						type: 'post',
						url: '<?php echo base_url(); ?>get_hml_file_route',
						data: txt_data,
						contentType: false,
						processData: false,   
						dataType: 'json',                     
						success: function(data)
						{         
							if(data=='EXPIRED SESSION')
							{
								Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
								
								setTimeout(function() {
									window.parent.location.href = "<?php echo base_url() ?>accounting_dashboard_route";
								}, 1000);
							}
							else
							{
								$("#print_btn").prop('disabled', false);
								$('#bu_dept_lbl').text(data.bu_dept);
								$('#sales_date_lbl').text(data.sales_date);
								$('#divbody_navcls_table').html(data.html);
								navcls_datatable(data.navcls_title);
							}
						}
					}); 
				}
			}
		}
	}  
	
	function navcls_datatable(navcls_title) 
	{
		$(document).ready(function() {
		$('#navcls_variance_table').DataTable({
			paging: false,
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
								columns: [0,1,2,3,4,5,6,7,8,9,10,11,12]
							}
						},
						{
							extend: 'csv',
							exportOptions: {
								columns: [0,1,2,3,4,5,6,7,8,9,10,11,12]
							}
						},
						{
							extend: 'excel',
							exportOptions: {
								columns: [0,1,2,3,4,5,6,7,8,9,10,11,12]
							}
						},
						// {
						// 	extend: 'pdf',
						// 	exportOptions: {
						// 		columns: [0,1,2,3,4,5,6,7,8,9,10,11,12]
						// 	}
						// },
						{
							extend: 'print',
							text: 'Print / PDF',
							title: navcls_title,
							footer: true,
							autoPrint: false,
							customize: function ( win ) {
							$(win.document.body)
								.css( 'font-size', '8pt' );
							/* .prepend(
									'<img src="<?php echo base_url(); ?>assets/image/alturas_logo.png" style="position:absolute; top:0; left:0;" />'
								);*/
							$(win.document.body).find( 'table' )
								.addClass( 'compact' )
								.css( 'font-size', 'inherit' );
							},
							exportOptions: {
								columns: [0,1,2,3,4,5,6,7,8,9,10,11,12]
							}
						}
					]
				}
			],
			"columnDefs": 
			[
			{"className": "text-center", "targets": [1,2,3,4,5,6,7,8,9,10,11,12]}
			],
			"order": [
			[0, "asc"]
			] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
		});
	  });
	}

	// function upload_file_js()
	// {
	// 	var file_name = $('#txt_file').val();
	// 	if(file_name == '')
	// 	{
	// 		Swal.fire('MISSING TEXT FILE', 'Please choose text file before click upload button.', 'error');
	// 		return;
	// 	}
	// 	else
	// 	{
	// 		// var validExtensions = ['htm','html','HTML','HTM']; //array of valid extensions
	// 		var validExtensions = ['txt','TXT','csv','CSV']; //array of valid extensions
	// 		var fileName = file_name;
	// 		var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
	// 		if ($.inArray(fileNameExt, validExtensions) == -1){
	// 			Swal.fire('INVALID FILE', 'Please select text file before click upload button.', 'error');
	// 			return;
	// 		}
	// 		else
	// 		{
	// 			if(file_name.replace(/\s/g, '') === "")
	// 			{
	// 				$('#txt_file').focus();
	// 			}
	// 			else
	// 			{
	// 				// for not disapear modal in clicking outside of the modal
	// 				$('#upload_loader').modal({
	// 					backdrop: 'static',
	// 					keyboard: false
	// 				});
	// 				// =================================================================
	// 				$(".btn").prop('disabled', true);
	// 				$("#upload_loader").show();
	// 				// =================================================================
	// 				var txt_data = new FormData();
	// 				var input = $('#txt_file')[0];
	// 				$.each(input.files, function(i, file)
	// 				{
	// 					txt_data.append('files[]', file);
	// 				});
					
	// 				$.ajax({
	// 					type: 'post',
	// 					url: '<?php echo base_url(); ?>upload_file_route',
	// 					data: txt_data,
	// 					contentType: false,
	// 					processData: false,   
	// 					dataType: 'json',                     
	// 					success: function(data)
	// 					{     
	// 						if(data == 'EXPIRED SESSION')
	// 						{
	// 							Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
								
	// 							setTimeout(function() {
	// 								window.parent.location.href = "<?php echo base_url() ?>accounting_dashboard_route";
	// 							}, 1000);
	// 						}
	// 						else if(data == 'INVALID TEXT FILE')
	// 						{
	// 							$(".btn").prop('disabled', false);
	// 							$("#upload_loader").hide();
	// 							Swal.fire('INVALID TEXT FILE', 'Please select a sales textfile from navition.', 'error');
	// 						}
	// 						else if(data == 'DUPLICATE TEXT FILE')
	// 						{
	// 							$(".btn").prop('disabled', false);
	// 							$("#upload_loader").hide();
	// 							Swal.fire('DUPLICATE TEXT FILE', 'Please select another sales textfile from navition.', 'error');
	// 						}
	// 						else if(data == 'INVALID CSV FILE')
	// 						{
	// 							$(".btn").prop('disabled', false);
	// 							$("#upload_loader").hide();
	// 							Swal.fire('INVALID CSV FILE', 'Please select a sales csv file from navition.', 'error');
	// 						}
	// 						else if(data == 'DUPLICATE CSV FILE')
	// 						{
	// 							$(".btn").prop('disabled', false);
	// 							$("#upload_loader").hide();
	// 							Swal.fire('DUPLICATE CSV FILE', 'Please select another sales csv file from navition.', 'error');
	// 						}
	// 						else if(data == 'MULTIPLE FILE')
	// 						{
	// 							$(".btn").prop('disabled', false);
	// 							$("#upload_loader").hide();
	// 							Swal.fire('MULTIPLE FILE', 'Please select 1 file only because uploading it takes a lot of time, multiple file uploading can cause log in your PC and missing other data.', 'error');
	// 						}
	// 						else
	// 						{
	// 							$(".btn").prop('disabled', false);
	// 							$("#upload_loader").hide();
	// 							display_sales_date_uploaded_js();
	// 						}
	// 					}
	// 				}); 
	// 			}
	// 		}
	// 	}
	// }  

	// ===============with progress bar====================

	function upload_file_js() {
		var file_name = $('#txt_file').val();
		if (file_name == '') {
			Swal.fire('MISSING TEXT FILE', 'Please choose text file before click upload button.', 'error');
			return;
		}

		var validExtensions = ['txt','TXT','csv','CSV'];
		var fileNameExt = file_name.substr(file_name.lastIndexOf('.') + 1);
		if ($.inArray(fileNameExt, validExtensions) == -1) {
			Swal.fire('INVALID FILE', 'Please select a valid file before click upload button.', 'error');
			return;
		}

		$('#upload_loader').modal({ backdrop: 'static', keyboard: false });
		$(".btn").prop('disabled', true);
		$("#upload_loader").show();

		var txt_data = new FormData();
		var input = $('#txt_file')[0];
		$.each(input.files, function(i, file) {
			txt_data.append('files[]', file);
		});

		$.ajax({
			type: 'post',
			url: '<?php echo base_url(); ?>upload_file_route',
			data: txt_data,
			contentType: false,
			processData: false,
			xhr: function() {
				var xhr = new window.XMLHttpRequest();
				var lastLineIndex = 0;
				var processingStopped = false;

				xhr.upload.addEventListener('progress', function(e) {
					if (e.lengthComputable) {
						var percent = Math.round((e.loaded / e.total) * 100);
						console.log('File upload: ' + percent + '%');
					}
				});

				xhr.onprogress = function() {
					if (processingStopped) return;

					var lines = xhr.responseText.split("\n");
					for (var i = lastLineIndex; i < lines.length; i++) {
						var line = lines[i].trim();
						if (line === '') continue;

						try {
							var obj = JSON.parse(line);
						} catch(e) {
							console.error('Invalid JSON:', line);
							continue;
						}

						if (obj.status === 'error') {
							processingStopped = true;
							$(".btn").prop('disabled', false);
							$("#upload_loader").modal('hide');
							Swal.fire('Error', obj.message, 'error');
							break;
						} else {
							$('#progress_bar').css('width', obj.progress + '%').text(obj.progress + '%');
							// $('#progress-status').text(`Processing row ${obj.currentRow} of ${obj.totalRows}...`);
						}
					}
					lastLineIndex = lines.length;
				};

				return xhr;
			},
			success: function(data) {
				if (typeof data === 'string') {
					try { data = JSON.parse(data); } 
					catch(e) { data = {}; }
				}

				if (data.status === 'error') {
					Swal.fire('Error', data.message, 'error');
				} else {
					$('#progress_bar').css('width', '100%').text('100%');
					$('#progress-status').text('Upload complete!');
					$(".btn").prop('disabled', false);
					$("#upload_loader").modal('hide');
					Swal.fire('Success', 'File uploaded successfully.', 'success');
					display_sales_date_uploaded_js();
				}
			}
		});
	}

	function display_sales_date_uploaded_js()
	{
		$.ajax({
			type: 'post',
			url: '<?php echo base_url(); ?>display_sales_date_uploaded_route',
			dataType: 'json',
			success: function(data) {
				$('#sales_date_dropdown').html(data.sales_date_html);
				Swal.fire('UPLOADED', 'You can now view variance report between nav and cls.', 'success');
				setTimeout(function() {
					window.parent.location.href = "<?php echo base_url() ?>unadjusted_navcls_route";
				}, 2000);
			}
		});
	}

	function display_sales_date_uploaded_js_v2()
	{
		// for not disapear modal in clicking outside of the modal
		$('#view_variance_loader').modal({
			backdrop: 'static',
			keyboard: false
		});
		// =================================================================
		$("#view_variance_loader").show();
		// =================================================================
		var date = $("#input_sales_date").val();
		$.ajax({
			type: 'post',
			url: '<?php echo base_url(); ?>display_sales_date_uploaded_route_v2',
			data: {'date': date},
			dataType: 'json',
			success: function(data) {
				$('#sales_date_dropdown').html(data.sales_date_html);
				if(data.sales_date_html != '' || data.sales_date_html == '')
				{
					$("#view_variance_loader").hide();
				}
			}
		});
	}

	function display_sales_date_uploaded_js2()
	{

		$('#view_variance_loader').modal({
			backdrop: 'static',
			keyboard: false
		});
		$("#view_variance_loader").show();

		$.ajax({
			type: 'post',
			url: '<?php echo base_url(); ?>display_sales_date_uploaded_route2',
			dataType: 'json',
			success: function(data) {
				$('#sales_date_dropdown').html(data.sales_date_html);
				if(data.sales_date_html != '' || data.sales_date_html == '')
				{
					$("#view_variance_loader").hide();
				}
			}
		});
	}

	function view_variance_navcls_js()
	{
		var data = $("#sales_date_dropdown").val().split(',');
		$.ajax({
			type: 'post',
			url: '<?php echo base_url(); ?>view_variance_navcls_route',
			data: {'sales_date': data[0],
				   'store_no': data[1],	
				   'bname': data[2],	
				   'dname': data[3]	
			},
			dataType: 'json',
			success: function(data) {
				if(data=='EXPIRED SESSION')
				{
					Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
					
					setTimeout(function() {
						window.parent.location.href = "<?php echo base_url() ?>accounting_dashboard_route";
					}, 1000);
				}
				else
				{
					$('#print_data').val($("#sales_date_dropdown").val());
					$('#bu_dept_lbl').html(data.buDeptName);
					$('#sales_date_lbl').html(data.sales_date);
					$('#divbody_navcls_table').html(data.html);
					navcls_variance_datatable();
				}
			}
		});
	}

	function view_variance_navcls_js_v2()
	{
		// Swal.fire('UNDER MAINTENANCE!', 'Please try again later.', 'info')
		// for not disapear modal in clicking outside of the modal
		$('#view_variance_loader').modal({
			backdrop: 'static',
			keyboard: false
		});
		// =================================================================
		$("#view_variance_loader").show();
		// =================================================================
		if($("#sales_date_dropdown").val() !== null){
			var data = $("#sales_date_dropdown").val().split(',');
			$.ajax({
				type: 'post',
				url: '<?php echo base_url(); ?>view_variance_navcls_route_v2',
				data: {'sales_date': data[0],
					'store_no': data[1],	
					'dcode': data[2],	
					'bname': data[3],	
					'dname': data[4],	
				},
				dataType: 'json',
				success: function(data) {
					if(data=='EXPIRED SESSION')
					{
						Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
						
						setTimeout(function() {
							window.parent.location.href = "<?php echo base_url() ?>accounting_dashboard_route";
						}, 1000);
					}
					else
					{
						$('#print_data').val($("#sales_date_dropdown").val());
						$('#bu_dept_lbl').html(data.buDeptName);
						$('#sales_date_lbl').html(data.sales_date);
						$('#mop_dropdown').html(data.mop_html); 
						$('#divbody_navcls_table').html(data.html);
						if(data.html != '')
						{
							$("#view_variance_loader").hide();
							navcls_variance_datatable();
						}
					}
				}
			});
		}else{
			$("#view_variance_loader").hide();
			Swal.fire('NO DATA', 'Please upload the sales before view variance.', 'error');
		}
	}

	function view_adjusted_variance_navcls_js()
	{
		// Swal.fire('UNDER MAINTENANCE!', 'Please try again later.', 'info')
		if($("#sales_date_dropdown option:selected").text() == '')
		{
			Swal.fire('NO DATA', '', 'error')
		}
		else
		{
			// for not disapear modal in clicking outside of the modal
			$('#view_variance_loader').modal({
				backdrop: 'static',
				keyboard: false
			});
			// =================================================================
			$("#view_variance_loader").show();
			// =================================================================
			var data = $("#sales_date_dropdown").val().split(',');
			$.ajax({
				type: 'post',
				url: '<?php echo base_url(); ?>view_adjusted_variance_navcls_route',
				data: {'sales_date': data[0],
					'store_no': data[1],	
					'dcode': data[2],	
					'bname': data[3],	
					'dname': data[4]	
				},
				dataType: 'json',
				success: function(data) {
					if(data=='EXPIRED SESSION')
					{
						Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
						
						setTimeout(function() {
							window.parent.location.href = "<?php echo base_url() ?>accounting_dashboard_route";
						}, 1000);
					}
					else
					{
						$('#print_data').val($("#sales_date_dropdown").val());
						$('#bu_dept_lbl').html(data.buDeptName);
						$('#sales_date_lbl').html(data.sales_date);
						$('#mop_dropdown').html(data.mop_html); 
						$('#divbody_navcls_table').html(data.html);
						if(data.html != '' || data.html == '')
						{
							$("#view_variance_loader").hide();
							navcls_variance_datatable();
						}
					}
				}
			});
		}
	}

	function view_variance_navcls_js2()
	{
		var data = $("#sales_date_dropdown").val().split(',');
		$.ajax({
			type: 'post',
			url: '<?php echo base_url(); ?>view_variance_navcls_route2',
			data: {'sales_date': data[0],
				   'store_no': data[1],	
				   'bname': data[2],	
				   'dname': data[3]	
			},
			dataType: 'json',
			success: function(data) {
				if(data=='EXPIRED SESSION')
				{
					Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
					
					setTimeout(function() {
						window.parent.location.href = "<?php echo base_url() ?>accounting_dashboard_route";
					}, 1000);
				}
				else
				{
					$('#print_data').val($("#sales_date_dropdown").val());
					$('#bu_dept_lbl').html(data.buDeptName);
					$('#sales_date_lbl').html(data.sales_date);
					$('#divbody_navcls_table').html(data.html);
					navcls_variance_datatable2();
				}
			}
		});
	}

	function navcls_variance_datatable2() 
	{
		$(document).ready(function() {
		$('#navcls_variance_table').DataTable({
			paging: false,
			"columnDefs": 
			[
			{"className": "text-center", "targets": [1,2,3,4,5,6,7,8,9,10,11,12]}
			],
			"order": [
			[1, "asc"]
			] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
		});
	  });
	}

	function navcls_variance_datatable() 
	{
		$(document).ready(function() {
		$('#navcls_variance_table').DataTable({
			paging: false,
			"scrollY": "400px",
    		"scrollX": true,
			// "columnDefs": 
			// [
			// {"className": "text-center", "targets": [1,2,3,4,5,6,7,8,9,10,11,12,13]}
			// ],
			"order": [
			[0, "asc"]
			] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
		});
	  });
	}

	function print_variance_js()
	{
		if($("#divbody_navcls_table").html() == '' || $("#bu_dept_lbl").text() == '' || $("#sales_date_lbl").text() == '')
		{
			Swal.fire('NO DATA', 'View variance first before print', 'error')
		}
		else
		{
			var table = $('#navcls_variance_table').DataTable();
			table.destroy();
			var bu_dept = $('#bu_dept_lbl').text();
			var sales_date = new Date($('#sales_date_lbl').text());
			sales_date = sales_date.toDateString();
			var title = '<h4><center>NAVISION VS CASHIER\'S LIQUIDATION SYSTEM<br>PAYMENT SUMMARY<br>'+bu_dept+'<br>'+sales_date+'</h4></center>';
			var divToPrint=document.getElementById('divbody_navcls_table');
			var newWin=window.open('','Print-Window');
			newWin.document.open();
			newWin.document.write('<html><body onload="window.print()"><style>@media print {.action {display:none;}}</style>'+title+divToPrint.innerHTML+'</body></html>');
			// newWin.document.write('<html><body onload="window.print()">'+title+divToPrint.innerHTML+'</body></html>');
			newWin.document.title = "NAVISION VS CASHIER\'S LIQUIDATION SYSTEM";
			newWin.document.close();
			setTimeout(function(){
				view_variance_navcls_js_v2();
				newWin.close();
			},10);
		}
	}

	function print_unadjusted_navcls_js()
	{
		// Swal.fire('UNDER MAINTENANCE', '', 'info');
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
		// =================================================================================================================================
		var data = $("#sales_date_dropdown").val().split(',');
		var mop_code = $("#mop_dropdown option:selected").val();
		var mop_name = $("#mop_dropdown option:selected").text();
		if(mop_name == '')
		{
			Swal.fire('NO DATA', 'View variance first before print', 'error');
			return;
		}
		else
		{
			io.open('POST', '<?php echo base_url('print_unadjusted_navcls_route'); ?>', { sales_date: data[0], store_no: data[1], dcode: data[2], bname: data[3], dname: data[4], mop_code: mop_code, mop_name: mop_name},'_blank');  
		}
	}

	function print_adjusted_navcls_js()
	{
		// Swal.fire('UNDER MAINTENANCE', '', 'info');
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
		// =================================================================================================================================
		var data = $("#sales_date_dropdown").val().split(',');
		var mop_code = $("#mop_dropdown option:selected").val();
		var mop_name = $("#mop_dropdown option:selected").text();
		if(mop_name == '')
		{
			Swal.fire('NO DATA', 'View variance first before print', 'error');
			return;
		}
		else
		{
			io.open('POST', '<?php echo base_url('print_adjusted_navcls_route'); ?>', { sales_date: data[0], store_no: data[1], dcode: data[2], bname: data[3], dname: data[4], mop_code: mop_code, mop_name: mop_name},'_blank');  
		}
	}

	function print_variance_js2()
	{
		if($("#divbody_navcls_table").html() == '' || $("#bu_dept_lbl").text() == '' || $("#sales_date_lbl").text() == '')
		{
			Swal.fire('NO DATA', 'View variance first before print', 'error')
		}
		else
		{
			var table = $('#navcls_variance_table').DataTable();
			table.destroy();
			var bu_dept = $('#bu_dept_lbl').text();
			var sales_date = new Date($('#sales_date_lbl').text());
			sales_date = sales_date.toDateString();
			var title = '<h4><center>NAVISION VS CASHIER\'S LIQUIDATION SYSTEM<br>PAYMENT SUMMARY<br>'+bu_dept+'<br>'+sales_date+'</h4></center>';
			var divToPrint=document.getElementById('divbody_navcls_table');
			var newWin=window.open('','Print-Window');
			newWin.document.open();
			newWin.document.write('<html><body onload="window.print()">'+title+divToPrint.innerHTML+'</body></html>');
			// newWin.document.write('<html><body onload="window.print()">'+title+divToPrint.innerHTML+'</body></html>');
			newWin.document.title = "NAVISION VS CASHIER\'S LIQUIDATION SYSTEM";
			newWin.document.close();
			setTimeout(function(){
				view_variance_navcls_js2();
				newWin.close();
			},10);
		}
	}

	function adjustment_js(sales_date,staff_id)
	{
		// for not disapear modal in clicking outside of the modal 
		$('#adjustment_modal').modal({
			backdrop: 'static',
			keyboard: false
		});
		$("#adjustment_modal").modal('show');
		$("#add_btn").show();
		$("#adjust_btn").hide();
		$("#origin_amount").val('');
		$("#transfer_mop").text('');
		$("#total_lbl").text('');
		$("#transfer_amount").val('');
		$("#terminal_no").html('');
		$("#adjustment_div").html('');
		$("#origin_mop").val('SELECT MOP');
		$("#origin_mop").prop('disabled', true);
		$("#reason").prop('disabled', true);
		$("#transfer_mop").prop('disabled', true);
		$("#transfer_amount").prop('disabled', true);
		$("#attached_file").prop('disabled', true);

		$.ajax({
			type: 'post',
			url: '<?php echo base_url(); ?>nav_adjustment_route',
			data: {'sales_date': sales_date,
				   'staff_id': staff_id
			},
			dataType: 'json',
			success: function(data) {
				$('#staff_name').text(data.staff_name);
				$('#terminal_no').html(data.terminal_no);

			}
		});
	}

	function view_attached_file_js(attached_file)
	{
		// for not disapear modal in clicking outside of the modal jaygwapo
		$('#attached_file_modal').modal({
			backdrop: 'static',
			keyboard: false
		});
		$("#attached_file_modal").modal('show');
		$("#attached_file_body").html('');
		var file = attached_file.split('|');
		for (let i = 0; i < file.length; i++) {
			$("#attached_file_body").append('<a onclick="view_file_js('+"'"+file[i]+"'"+')"><img class="img-fluid" src="<?php echo base_url();?>accounting_attached_file/'+file[i]+'" height="220" width="240" style="padding: 5px;" /></a>');
		}
	}

	function view_file_js(file_name)
	{
		$('#imagemodal').modal({
			backdrop: 'static',
			keyboard: false
		});
		$('.imagepreview').attr('src', '<?php echo base_url();?>accounting_attached_file/'+file_name);
		$('#imagemodal').modal('show');   
	}

	function get_mop_amount_js()
	{
		$("#add_btn").show();
		$("#adjust_btn").show();
		$("#transfer_mop").prop('disabled', false);
		$("#transfer_amount").prop('disabled', false);
		$("#reason").prop('disabled', false);
		$("#attached_file").prop('disabled', false);
		var mop_val = $("#origin_mop option:selected").val().split('|');
		var amount = mop_val[0];
		$("#origin_amount").val(amount);
		
		var store = mop_val[4].split('-');
		$.ajax({
			type: 'post',
			url: '<?php echo base_url(); ?>get_all_mop_route',
			data: {'store': store[0],
				   'tender_type': $("#origin_mop option:selected").text(),
				   'origin_code': mop_val[1],
				   'sales_date': mop_val[2],
				   'staff_id': mop_val[3],
				   'store_no': mop_val[4],
				   'dcode': mop_val[5],
				   'terminal_no': mop_val[6]
			},
			dataType: 'json',
			success: function(data) {
				$('#transfer_mop').html(data.all_tender_name);
				$('#total_lbl').text(data.total);
				$('#adjustment_div').html(data.adjustment_list);

				// =================================================================================
				if (data.hide === 'hidden') {
					$("#add_btn, #adjust_btn").hide();
					$("#transfer_mop, #transfer_amount, #reason, #attached_file").prop('disabled', true);
				} else {
					if (data.status === 'EMPTY') {
						$("#add_btn").show();
						$("#adjust_btn").hide();
					} else if (data.status === 'APPROVED') {
						$("#add_btn").hide();
						$("#adjust_btn").show();
						$("#adjust_btn").prop('disabled', false);

					} else if (data.status === 'PENDING') {
						$("#add_btn").show();
						$("#adjust_btn").hide();
					}
				}
			}

		});
	}

	function maxmin_amount_js()
	{
		var origin = $("#origin_amount").val().split(',').join('');
		var transfer = $("#transfer_amount").val().split(',').join('');
		if(parseFloat(transfer) > parseFloat(origin))
		{
			Swal.fire('INVALID AMOUNT', 'Transfer amount is not greater than origin', 'error')
			return;
		}
	}

	function sumbmit_adjustment_js()
	{
		if($("#transfer_mop option:selected").text() == 'SELECT MOP' || $("#transfer_mop").text() == '')
		{
			Swal.fire('MISSING MOP', 'Please select mode of payment before adjust.', 'error')
			return;
		}
		else if($("#transfer_amount").val() == '' || $("#transfer_amount").val() <= 0)
		{
			Swal.fire('MISSING AMOUNT', 'Please input amount before adjust.', 'error')
			return;
		}
		else
		{
			var data = $("#origin_mop option:selected").val().split('|');
			var data2 = $("#transfer_mop option:selected").val();
			var data3 = $("#transfer_mop option:selected").text();
			var origin_amount = $("#origin_amount").val().split(',').join('');
			var transfer_amount = $("#transfer_amount").val().split(',').join('');
			var adjusted_amount = origin_amount - transfer_amount;

			$.ajax({
				type: 'post',
				url: '<?php echo base_url(); ?>sumbmit_adjustment_route',
				data: {'origin_tender': data[1],
					   'sales_date': data[2],
					   'staff_id': data[3],
					   'store_no': data[4],
					   'transfer_tender_code': data2,
					   'transfer_tender_name': data3,
					   'origin_amount': adjusted_amount,
					   'transfer_amount': transfer_amount
				},
				dataType: 'json',
				success: function(data) {
					if(data=='EXPIRED SESSION')
					{
						Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
						
						setTimeout(function() {
							window.parent.location.href = "<?php echo base_url() ?>accounting_dashboard_route";
						}, 1000);
					}
					else
					{
						adjustment_js(data.sales_date,data.staff_id)
						Swal.fire('ADJUSTED', '', 'success')
					}
				}
			});
		}
	}

	function add_adjustment_js()
	{
		if($("#transfer_mop option:selected").text() == 'SELECT MOP' || $("#transfer_mop").text() == '')
		{
			Swal.fire('MISSING MOP', 'Please select mode of payment before add.', 'error')
			return;
		}
		else if($("#transfer_amount").val() == '' || $("#transfer_amount").val() <= 0)
		{
			Swal.fire('MISSING AMOUNT', 'Please input amount before add.', 'error')
			return;
		}
		else if($("#reason").val() == '')
		{
			Swal.fire('MISSING REASON', 'Please input reason before add.', 'error')
			return;
		}
		else if($("#attached_file").val() == '')
		{
			Swal.fire('MISSING FILE', 'Please attached file before add.', 'error')
			return; 
		}
		else
		{
			var validExtensions = ['jpg','JPG','jpeg','JPEG','png','PNG']; //array of valid extensions
			var fileName = $("#attached_file").val();
			var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
			if ($.inArray(fileNameExt, validExtensions) == -1){
				Swal.fire('INVALID FILE', 'Please select image jpg or png extension.', 'error');
				return;
			}
			else
			{
				var origin_mop = $("#origin_mop option:selected").val().split('|');
				var origin_mop_name = $("#origin_mop option:selected").text();
				var transfer_mop_code = $("#transfer_mop option:selected").val();
				var transfer_mop_name = $("#transfer_mop option:selected").text();
				var origin_amount = $("#origin_amount").val().split(',').join('');
				var transfer_amount = $("#transfer_amount").val().split(',').join('');
				var adjusted_amount = origin_amount - transfer_amount;
				var reason = $("#reason").val();
				var file = $("#selected_file").val();
				// =================================================================
				var form_data = new FormData();
				// Read selected files
				var totalfiles = document.getElementById('attached_file').files.length;
				for (var index = 0; index < totalfiles; index++) {
				form_data.append("files[]", document.getElementById('attached_file').files[index]);
				}
				// =================================================================
				$.ajax({
					type: 'post',
					url: '<?php echo base_url(); ?>add_adjustment_route',
					data: {'origin_code': origin_mop[1],
						'origin_name': origin_mop_name,
						'sales_date': origin_mop[2],
						'staff_id': origin_mop[3],
						'store_no': origin_mop[4],
						'dcode': origin_mop[5],
						'terminal_no': origin_mop[6],
						'transfer_code': transfer_mop_code,
						'transfer_name': transfer_mop_name,
						'transfer_amount': transfer_amount,
						'reason': reason,
						'file_data': file
					}, 
					dataType: 'json',
					success: function(data) {
						if(data=='EXPIRED SESSION')
						{
							Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
							
							setTimeout(function() {
								window.parent.location.href = "<?php echo base_url() ?>accounting_dashboard_route";
							}, 1000);
						}
						else if(data == 'DUPLICATE')
						{
							Swal.fire('ALREADY EXIST', '', 'error')
						}
						else
						{
							upload_attached_file_js(form_data);
							pending_adjustment_js(origin_mop[1],origin_mop[2],origin_mop[3],origin_mop[4],origin_mop[6]);
						}
					}
				});
			}
		}
	}

	function upload_attached_file_js(form_data)
	{
		$.ajax({
			type: 'post',
			url: '<?php echo base_url(); ?>upload_attached_file_route',
			data: form_data,
			contentType: false,
			processData: false,   
			dataType: 'json',
			success: function(data) {

			}
		});
	}

	function pending_adjustment_js(origin_code,sales_date,staff_id,store_no,terminal_no)
	{
		$.ajax({
			type: 'post',
			url: '<?php echo base_url(); ?>pending_adjustment_route',
			data: {'origin_code': origin_code,
				   'sales_date': sales_date,
				   'staff_id': staff_id,
				   'store_no': store_no,
				   'terminal_no': terminal_no
			},
			dataType: 'json',
			success: function(data) {
				$("#reason").val('');
				$("#attached_file").val('');
				$("#transfer_amount").val('');
				$('#total_lbl').text(data.total);
				$('#adjustment_div').html(data.adjustment_list);
				// =================================================================================
				if(data.hide == 'hidden')
				{
					$("#add_btn").hide();
					$("#adjust_btn").hide();
					$("#transfer_mop").prop('disabled', true);
					$("#transfer_amount").prop('disabled', true);
					$("#reason").prop('disabled', true);
					$("#attached_file").prop('disabled', true);
				}
				else
				{
					if(data.status == 'EMPTY')
					{
						$("#add_btn").show();
						$("#adjust_btn").hide();
					}
				}
				// ====================================================================================jaygwapo
				if(data.status == 'APPROVED')
				{
					$("#add_btn").hide();
					$("#adjust_btn").show();
				}
				else if(data.status == 'PENDING')
				{
					$("#add_btn").show();
					$("#adjust_btn").hide();
				}
			}
		});
	}

	function GetFileInfo() 
	{
		var fileInput = document.getElementById("attached_file");
		var message = "";
		if ('files' in fileInput) {
			if (fileInput.files.length == 0) {
				message = "";
			} else {
				for (var i = 0; i < fileInput.files.length; i++) {
					var file = fileInput.files[i];
					if ('name' in file) {
						message += file.name + "|";
					}
				}
			}
		} 
		message = message.slice(0,-1);
		$("#selected_file").val(message);
	}

	function delete_adjustment_js(id,origin_code,sales_date,staff_id,store_no,terminal_no)
	{
		$.ajax({
			type: 'post',
			url: '<?php echo base_url(); ?>delete_adjustment_route',
			data: {'id': id},
			dataType: 'json',
			success: function(data) {
				pending_adjustment_js(origin_code,sales_date,staff_id,store_no,terminal_no);
			}
		});
	}

	function sumbmit_adjustment_js_v2()
	{
		Swal.fire({
		title: 'Are you sure you want to adjust?',
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

			
			var origin_mop = $("#origin_mop option:selected").val().split('|');
			var origin_amount = $("#origin_amount").val().split(',').join('');
			var total_lbl = $("#total_lbl").text().split(',').join('');
			var origin_adjusted_amount = origin_amount - total_lbl;
			
			if(parseFloat(total_lbl) == 0)
			{
				Swal.fire('MISSING MOP / AMOUNT', 'Please add mode of payment and amount first before adjust.', 'error')
				return;
			}
			else if(parseFloat(total_lbl) > parseFloat(origin_amount))
			{
				Swal.fire('INVALID AMOUNT', 'Transfer amount must not greater than origin amount.', 'error')
				return;
			}
			else if($("#origin_amount").val() == '')
			{
				Swal.fire('MISSING MOP', 'Please select mode of payment before adjust.', 'error')
				return;
			}
			else
			{
				$.ajax({
					type: 'post',
					url: '<?php echo base_url(); ?>sumbmit_adjustment_route_v2',
					data: {'origin_code': origin_mop[1],
						'sales_date': origin_mop[2],
						'staff_id': origin_mop[3],
						'store_no': origin_mop[4],
						'terminal_no': origin_mop[6],
						'origin_adjusted_amount': origin_adjusted_amount
					},
					dataType: 'json',
					success: function(data) {
						if(data=='EXPIRED SESSION')
						{
							Swal.fire('EXPIRED SESSION', 'Please relogin your HRMS', 'error')
							
							setTimeout(function() {
								window.parent.location.href = "<?php echo base_url() ?>accounting_dashboard_route";
							}, 1000);
						}
						else
						{
							pending_adjustment_js(origin_mop[1],origin_mop[2],origin_mop[3],origin_mop[4],origin_mop[6]);
							$("#add_btn").prop('disabled', true);
							$("#adjust_btn").prop('disabled', true);
							Swal.fire('ADJUSTED', '', 'success')
						}
					}
				});
			}

		} else if (result.isDenied) {
			Swal.fire('CANCELLED', '', 'info')
		}
		})
	}

	function validate_mop_transfer_js()
	{
		$("#add_btn").show();
		$("#reason").prop('disabled', false);
		$("#add_btn").prop('disabled', false);
		$("#attached_file").prop('disabled', false);
		$("#transfer_amount").prop('disabled', false);
		var origin_mop = $("#origin_mop option:selected").val().split('|');
		var origin_mop_name = $("#origin_mop option:selected").text();
		var transfer_mop_name = $("#transfer_mop option:selected").text();

		$.ajax({
			type: 'post',
			url: '<?php echo base_url(); ?>validate_mop_transfer_route',
			data: {'sales_date': origin_mop[2],
				   'staff_id': origin_mop[3],
				   'store_no': origin_mop[4],
				   'terminal_no': origin_mop[6],
				   'origin_name': origin_mop_name,
				   'transfer_name': transfer_mop_name
			},
			dataType: 'json',
			success: function(data) {
				if(data == 'ADJUSTED')
				{
					$("#adjust_btn").hide();
					$("#reason").val('');
					$("#attached_file").val('');
					$("#transfer_amount").val('');
					$("#reason").prop('disabled', true);
					$("#add_btn").prop('disabled', true);
					$("#attached_file").prop('disabled', true);
					$("#transfer_amount").prop('disabled', true);
					Swal.fire('ALREADY ADJUSTED', '<span style="font-weight: bold;">Origin:&nbsp;'+transfer_mop_name+'&nbsp;|&nbsp;Transfer to:&nbsp;'+origin_mop_name+'</span><br>please check your adjustment history.', 'error');
				}
				else if(data == 'PENDING')
				{
					$("#adjust_btn").hide();
					$("#reason").val('');
					$("#attached_file").val('');
					$("#transfer_amount").val('');
					$("#reason").prop('disabled', true);
					$("#add_btn").prop('disabled', true);
					$("#attached_file").prop('disabled', true);
					$("#transfer_amount").prop('disabled', true);
					Swal.fire('DUPLICATE', '<span style="font-weight: bold;">Origin:&nbsp;'+transfer_mop_name+'&nbsp;|&nbsp;Transfer to:&nbsp;'+origin_mop_name+'</span><br>please check your adjustment history.', 'error');
				}
			}
		});
	}

	function display_adjustment_history_js()
	{
		$.ajax({
			type: 'post',
			url: '<?php echo base_url(); ?>display_adjustment_history_route',
			dataType: 'json',
			success: function(data) {
				$("#divbody_adjustment_history_table").html(data.html);
				adjustment_history_datatable();
			}
		});
	}

	function adjustment_history_datatable() 
	{
		$(document).ready(function() {
			$('#adjustment_history_table').DataTable({
				"columnDefs": 
				[
				{"className": "text-center", "targets": [1,2,3,4,5,6]}
				],
				"order": [
				[4, "asc"]
				] // OR  order: [[ 3, 'desc' ], [ 0, 'asc' ]]
			});
		});
	}

	function get_nav_terminal_data_js()
	{
		$("#adjustment_div").html('');
		$("#origin_amount").val('');
		$("#reason").val('');
		$("#transfer_mop").val('');
		$("#transfer_amount").val('');
		$("#attached_file").val('');
		$("#reason").prop('disabled', true);
		$("#transfer_mop").prop('disabled', true);
		$("#transfer_amount").prop('disabled', true);
		$("#attached_file").prop('disabled', true);
		var data = $("#terminal_no option:selected").val().split('|');
		$.ajax({
			type: 'post',
			url: '<?php echo base_url(); ?>get_nav_terminal_data_route',
			data: {'sales_date': data[0],
				'staff_id': data[1],
				'terminal_no': data[2]
			},
			dataType: 'json',
			success: function(data) {
				$("#origin_mop").html(data.tender_name);
				$("#origin_mop").prop('disabled', false);
			}
		});
	}


	//Louei Code For Print All Mode OF Payment and Overall Total
	
	function print_unadjusted_navcls_js_all() {

		$('#generate_pdf').modal({
			backdrop: 'static',
			keyboard: false
		});
		$("#generate_pdf").show();

		var data = $("#sales_date_dropdown").val().split(',');
		console.log(data);
		$.ajax({
			url: '<?php echo base_url('Accounting_controller/mop'); ?>',
			method: 'POST',
			data: { 
				sales_date: data[0],
				bname: data[3],
				dname: data[4],
				store_no: data[1],
			},
			success: function(response) {
				var res = JSON.parse(response);
				var mop_names = res.map(item => item.mop_name).join('|');
				var mop_codes = res.map(item => item.mop_code).join('|');
				console.log(mop_names);
				console.log(mop_codes);
				window.io = {
					open: function(verb, url, data, target) {
						var form = document.createElement("form");
						form.action = url;
						form.method = verb;
						form.target = target || "_blank";
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

				$("#generate_pdf").hide();

				window.io.open(
					'POST',
					'<?php echo base_url('Accounting_controller/print_unadjusted'); ?>', 
					{ 
						sales_date: data[0],
						store_no: data[1], 
						dcode: data[2], 
						bname: data[3], 
						dname: data[4], 
						mop_code: mop_codes, 
						mop_name: mop_names,
					},
					'_blank'
				);

			},
			error: function(xhr, status, error) {
				console.error('AJAX Error: ' + status + error);
				$("#generate_pdf").hide();
			}
		});
	}


</script>